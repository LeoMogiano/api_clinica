<?php

namespace App\Http\Controllers;

use OpenCV\CascadeClassifier;
use OpenCV\RectVector;
use OpenCV\FaceRecognizer;
use OpenCV\DescriptorExtractor;
use OpenCV\FeatureDetector;
use Illuminate\Http\Request;

class ReconocimientoController extends Controller
{
    public function reconocer(Request $request)
    {
        // Ruta del archivo de imagen recibido
        $imagenPath = $request->file('imagen')->path();

        // Preprocesamiento de imágenes
        $normalizedImage = $this->preprocessImage($imagenPath);

        // Extracción de características
        $features = $this->extractFaceFeatures($normalizedImage);

        // Lógica adicional de reconocimiento facial y respuesta

        return response()->json($features);
    }

    private function preprocessImage($imagePath)
    {

        $image = OpenCV::load($imagePath);

        // Convertir la imagen a escala de grises
        $gray = $image->cvtColor(OpenCV::COLOR_BGR2GRAY);

        // Redimensionar la imagen a un tamaño estándar
        $resized = $gray->resize(128, 128);

        // Normalizar los valores de píxeles
        $normalized = $resized->div(255.0);

        return $normalized;
    }

    private function extractFaceFeatures($image)
    {
        $classifierPath = public_path('haarcascade_frontalface_default.xml');
        $classifier = new CascadeClassifier($classifierPath);
        $faces = new RectVector();
        $classifier->detectMultiScale($image, $faces);

        $features = [];

        foreach ($faces as $face) {
            $faceImage = $image->getImageROI($face);

            // Extraer características del rostro utilizando OpenCV
            // Por ejemplo, puedes utilizar el detector de puntos clave ORB
            $detector = new FeatureDetector(FeatureDetector::ORB);
            $keypoints = $detector->detect($faceImage);

            $features[] = $keypoints;
        }

        return $features;
    }

    public function entrenamiento()
    {
        $model = OpenCV::createLBPHFaceRecognizer();
        $trainer = new Trainer($model);

        $trainingImagesPath = storage_path('app/entrenamiento/');
        $labels = [];

        $files = scandir($trainingImagesPath);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $imagePath = $trainingImagesPath . $file;
                $image = OpenCV::load($imagePath);

                // Convertir la imagen a escala de grises
                $gray = $image->cvtColor(OpenCV::COLOR_BGR2GRAY);

                // Obtener el ID de la imagen a partir del nombre del archivo
                $id = intval(pathinfo($file, PATHINFO_FILENAME));
                $labels[] = $id;

                // Agregar la imagen y su ID al entrenador
                $trainer->addData($gray, $id);
            }
        }

        // Entrenar el modelo
        $trainer->train();

        // Guardar el modelo entrenado en un archivo
        $trainedModelPath = storage_path('app/trained_model.yml');
        $model->save($trainedModelPath);

        // Guardar las etiquetas en un archivo
        $labelsFile = storage_path('app/labels.txt');
        file_put_contents($labelsFile, implode(PHP_EOL, $labels));

        return response()->json([
            'message' => 'Modelo Entrenado con Exíto'
        ]);
    }

    public function comparar(Request $request)
    {
        // Ruta del archivo de imagen 1 recibido
        $imagen1Path = $request->file('imagen1')->path();
        // Ruta del archivo de imagen 2 recibido
        $imagen2Path = $request->file('imagen2')->path();

        // Preprocesamiento de imágenes
        $normalizedImage1 = $this->preprocessImage($imagen1Path);
        $normalizedImage2 = $this->preprocessImage($imagen2Path);

        // Extracción de características de las imágenes
        $features1 = $this->extractFaceFeatures($normalizedImage1);
        $features2 = $this->extractFaceFeatures($normalizedImage2);

        // Comparación de características y obtención de resultado
        $similarity = $this->useModel(ComparacionFacial,$features1, $features2);

        return response()->json([
            'similarity' => $similarity
        ]);
    }
}
