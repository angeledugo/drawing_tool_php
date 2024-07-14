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
                //echo "entro en L";
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
     *  Renderizar el lienzo
     */

    private function renderCanvas(): string
    {
        return implode("\n", array_map(fn($row) => implode('', $row), $this->canvas));
    }
}
