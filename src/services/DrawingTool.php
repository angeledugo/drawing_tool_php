<?php 
namespace App\Services;

class DrawingTool {

    // Array Bidemensional Lienzo 
    private array $canvas = [];



    /**
     * Recibe un string con todos los comandos y separa por lineas 
     * renderiza el lienzo como una cadena
     */
    public function executeCommands(string $input) {
                    
        $commands = explode("\n", $input);
        foreach ($commands as $command) {
            $this->executeCommand($command);
        }

        return $this->renderCanvas();
    }

    /**
     * Toma una Cadena con un comando individual y llama 
     * a su funcion basadose en la primera letra
     */

    public function executeCommand(string $command) {
        $parts = explode(' ', $command);
        switch ($parts[0]) {
            case 'C':
                $this->createCanvas((int)$parts[1], (int)$parts[2]);
                break;
            case 'L':
                $this->drawLine((int)$parts[1], (int)$parts[2], (int)$parts[3], (int)$parts[4]);
                break;
            case 'R':
                $this->drawRectangle((int)$parts[1], (int)$parts[2], (int)$parts[3], (int)$parts[4]);
                break;

        }

    }
    /**
     * Creando Lienzo con el ancho y alto especificados, 
     * añadiendo un borde alrededor
     */

    private function createCanvas(int $width, int $height): void
    {
        $this->canvas = array_fill(0, $height + 2, array_fill(0, $width + 2, ' '));
        for ($i = 0; $i < $width + 2; $i++) {
            $this->canvas[0][$i] = '-';
            $this->canvas[$height + 1][$i] = '-';
        }
        for ($i = 1; $i <= $height; $i++) {
            $this->canvas[$i][0] = '|';
            $this->canvas[$i][$width + 1] = '|';
        }
    }

    /**
     * Dibuja ena linea vertical u horizontal en el lienzo
     * representado por una matriz bidireccional
     */

    private function drawLine(int $x1, int $y1, int $x2, int $y2): void
    {
        // verifica si los valores de x1 y x2 son iguales, lo que indica que la línea es vertical.
        // verifica si los valores de y1 y y2 son iguales, lo que indica que la línea es horizontal.
        if ($x1 == $x2) {
            for ($y = min($y1, $y2); $y <= max($y1, $y2); $y++) {
                $this->canvas[$y][$x1] = 'x';
            }
        } elseif ($y1 == $y2) {
            for ($x = min($x1, $x2); $x <= max($x1, $x2); $x++) {
                $this->canvas[$y1][$x] = 'x';
            }
        }
    }

    /**
     * dibuja un rectángulo llamando a drawLine cuatro veces para crear los cuatro lados.
     */
    private function drawRectangle(int $x1, int $y1, int $x2, int $y2): void
    {
        $this->drawLine($x1, $y1, $x2, $y1);
        $this->drawLine($x1, $y2, $x2, $y2);
        $this->drawLine($x1, $y1, $x1, $y2);
        $this->drawLine($x2, $y1, $x2, $y2);
    }

    

    /**
     *  Renderizar el lienzo
     */

    private function renderCanvas(): string
    {
        return implode("\n", array_map(fn($row) => implode('', $row), $this->canvas));
    }
}
