<?php
// phpcs:ignoreFile

use Rubix\ML\Datasets\Labeled;
use Rubix\ML\PersistentModel;
use Rubix\ML\Persisters\Filesystem;
use Rubix\ML\Transformers\ImageResizer;
use Rubix\ML\Transformers\ImageVectorizer;
use Rubix\ML\CrossValidation\Metrics\Accuracy;
use Rubix\ML\CrossValidation\HoldOut;
use Rubix\ML\NeuralNet\Optimizers\Adam;
use Rubix\ML\NeuralNet\Layers\Dense;
use Rubix\ML\NeuralNet\Layers\Dropout;
use Rubix\ML\NeuralNet\Layers\Activation;
use Rubix\ML\NeuralNet\ActivationFunctions\LeakyReLU;
use Rubix\ML\NeuralNet\CostFunctions\CrossEntropy;
use Rubix\ML\NeuralNet\Classifiers\MultiLayerPerceptron;

// Cargar y preprocesar los datos de entrenamiento
$dataset = Labeled::fromIterator(new ImageLoader('path/to/training/images'), true)
    ->apply(new ImageResizer(224, 224))
    ->apply(new ImageVectorizer());

// Separar los datos en conjuntos de entrenamiento y prueba
$split = new HoldOut(0.8);
[$trainingSamples, $testingSamples] = $split->split($dataset)->samples();

// Definir la arquitectura del modelo
$estimator = new PersistentModel(
    new MultiLayerPerceptron([
        new Dense(128),
        new Activation(new LeakyReLU()),
        new Dropout(0.5),
        new Dense($dataset->possibleOutcomes()),
        new Activation(new LeakyReLU()),
    ], new CrossEntropy()),
    new Filesystem('path/to/model/file')
);

// Entrenar el modelo
$estimator->train($trainingSamples, new Adam(0.001), 100, 32, new Accuracy());

// Evaluar el modelo en el conjunto de prueba
$score = $estimator->score($testingSamples);

