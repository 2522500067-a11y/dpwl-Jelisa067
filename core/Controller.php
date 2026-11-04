
<?php
class Controller
{
    public $load;
    public $session;

    public function __construct()
    {
        if (class_exists('Session')) {
            $this->session = new Session();
        }

        $controller = $this;

        $this->load = new class($controller)
        {
            private $controller;

            public function __construct($controller)
            {
                $this->controller = $controller;
            }

            // Method untuk memanggil View
            public function view($view, $data = [])
            {
                return $this->controller->view($view, $data);
            }

            // Method untuk memanggil Model
            public function model($model)
            {
                return $this->controller->model($model);
            }

            // Method untuk mengambil data POST
            public function post($nama)
            {
                return $_POST[$nama] ?? null;
            }
        };
    }

    // Method untuk memanggil/load View
    public function view($view, $data = [])
    {
        extract($data);

        $viewFile = __DIR__ . '/../view/' . $view . '.php';

        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            die("View file '$view' tidak ditemukan pada jalur: " . $viewFile);
        }
    }

    // Method untuk memanggil/load Model
    public function model($model)
    {
        $modelFile = __DIR__ . '/../model/' . $model . '.php';

        if (file_exists($modelFile)) {
            require_once $modelFile;

            $className = basename($model);

            if (class_exists($className)) {
                return new $className();
            } else {
                die("Class '$className' tidak ditemukan di dalam file '$model.php'.");
            }
        } else {
            die("Error: File Model tidak ditemukan pada jalur: " . $modelFile);
        }
    }
}
