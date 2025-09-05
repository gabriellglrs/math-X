<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View as ViewFacade;
use Carbon\Carbon;

class MainController extends Controller
{
    public function home(): View
    {
        return view('home');
    }

    public function generateExercises(Request $request): View
    {
        $request->validate([
            'check_sum' => 'required_without_all:check_subtraction,check_multiplication,check_division',
            'check_subtraction' => 'required_without_all:check_sum,check_multiplication,check_division',
            'check_multiplication' => 'required_without_all:check_sum,check_subtraction,check_division',
            'check_division' => 'required_without_all:check_sum,check_subtraction,check_multiplication',
            'number_one' => 'required|integer|min:0|max:999|lt:number_two',
            'number_two' => 'required|integer|min:0|max:999',
            'number_exercises' => 'required|integer|min:1|max:50'
        ], [
            'check_sum.required_without_all' => 'Selecione pelo menos uma operação matemática.',
            'check_subtraction.required_without_all' => 'Selecione pelo menos uma operação matemática.',
            'check_multiplication.required_without_all' => 'Selecione pelo menos uma operação matemática.',
            'check_division.required_without_all' => 'Selecione pelo menos uma operação matemática.',
            'number_one.lt' => 'O valor mínimo deve ser menor que o valor máximo.',
            'number_one.min' => 'O valor mínimo deve ser pelo menos 0.',
            'number_one.max' => 'O valor mínimo não pode ser maior que 999.',
            'number_two.min' => 'O valor máximo deve ser pelo menos 1.',
            'number_two.max' => 'O valor máximo não pode ser maior que 999.',
            'number_exercises.min' => 'Deve haver pelo menos 1 exercício.',
            'number_exercises.max' => 'Não pode haver mais de 50 exercícios.',
        ]);

        $operations = [];
        if ($request->check_sum) $operations[] = 'sum';
        if ($request->check_subtraction) $operations[] = 'subtraction';
        if ($request->check_multiplication) $operations[] = 'multiplication';
        if ($request->check_division) $operations[] = 'division';

        $min = $request->number_one;
        $max = $request->number_two;
        $numberExercises = $request->number_exercises;

        $exercises = [];
        $metadata = [
            'generated_at' => Carbon::now(),
            'total_exercises' => $numberExercises,
            'operations' => $operations,
            'range' => ['min' => $min, 'max' => $max]
        ];

        for ($index = 1; $index <= $numberExercises; $index++) {
            $operation = $operations[array_rand($operations)];
            $number1 = rand($min, $max);
            $number2 = rand($min, $max);

            $exercise = '';
            $solution = '';
            $difficulty = '';

            switch ($operation) {
                case 'sum':
                    $exercise = "$number1 + $number2 =";
                    $solution = $number1 + $number2;
                    $difficulty = $this->calculateDifficulty('sum', $number1, $number2);
                    break;

                case 'subtraction':
                    // Garantir resultado positivo
                    if ($number1 < $number2) {
                        $temp = $number1;
                        $number1 = $number2;
                        $number2 = $temp;
                    }
                    $exercise = "$number1 - $number2 =";
                    $solution = $number1 - $number2;
                    $difficulty = $this->calculateDifficulty('subtraction', $number1, $number2);
                    break;

                case 'multiplication':
                    $exercise = "$number1 × $number2 =";
                    $solution = $number1 * $number2;
                    $difficulty = $this->calculateDifficulty('multiplication', $number1, $number2);
                    break;

                case 'division':
                    $number2 = ($number2 == 0) ? 1 : $number2;
                    $exercise = "$number1 ÷ $number2 =";
                    $solution = round($number1 / $number2, 2);
                    $difficulty = $this->calculateDifficulty('division', $number1, $number2);
                    break;
            }

            $exercises[] = [
                'exercise_number' => $index,
                'exercise' => $exercise,
                'solution' => $solution,
                'operation' => $operation,
                'difficulty' => $difficulty,
                'numbers' => ['number1' => $number1, 'number2' => $number2]
            ];
        }

        // Armazenar exercícios na sessão para uso posterior
        session(['current_exercises' => $exercises, 'exercises_metadata' => $metadata]);

        return view('operations', compact('exercises', 'metadata'));
    }

    private function calculateDifficulty(string $operation, int $number1, int $number2): string
    {
        switch ($operation) {
            case 'sum':
                $sum = $number1 + $number2;
                if ($sum <= 20) return 'Fácil';
                if ($sum <= 100) return 'Médio';
                return 'Difícil';

            case 'subtraction':
                if ($number1 <= 20 && $number2 <= 10) return 'Fácil';
                if ($number1 <= 100 && $number2 <= 50) return 'Médio';
                return 'Difícil';

            case 'multiplication':
                if (($number1 <= 5 && $number2 <= 5) || ($number1 <= 10 && $number2 == 1)) return 'Fácil';
                if ($number1 <= 12 && $number2 <= 12) return 'Médio';
                return 'Difícil';

            case 'division':
                if ($number1 <= 50 && $number2 <= 10) return 'Fácil';
                if ($number1 <= 200 && $number2 <= 20) return 'Médio';
                return 'Difícil';

            default:
                return 'Médio';
        }
    }

    public function printExercises()
    {
        $exercises = session('current_exercises', []);
        $metadata = session('exercises_metadata', []);

        if (empty($exercises)) {
            return redirect()->route('home')->with('error', 'Nenhum exercício encontrado para impressão.');
        }

        // Verificar se a view existe, senão usar HTML simples
        if (ViewFacade::exists('print-exercises')) {
            $printHtml = view('print-exercises', compact('exercises', 'metadata'))->render();
        } else {
            $printHtml = $this->generateSimplePrintHtml($exercises, $metadata);
        }

        return response($printHtml)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', 'inline; filename="exercicios-matematica.html"');
    }

    public function exportExercises(): RedirectResponse|Response
    {
        $exercises = session('current_exercises', []);
        $metadata = session('exercises_metadata', []);

        if (empty($exercises)) {
            return redirect()->route('home')->with('error', 'Nenhum exercício encontrado para exportação.');
        }

        $content = $this->generateTextContent($exercises, $metadata);
        $filename = 'exercicios-matematica-' . date('Y-m-d-H-i-s') . '.txt';

        return response($content)
            ->header('Content-Type', 'text/plain; charset=utf-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function downloadPDF()
    {
        $exercises = session('current_exercises', []);
        $metadata = session('exercises_metadata', []);

        if (empty($exercises)) {
            return redirect()->route('home')->with('error', 'Nenhum exercício encontrado.');
        }

        // Verificar se a view existe, senão usar HTML simples
        if (ViewFacade::exists('pdf-exercises')) {
            $html = view('pdf-exercises', compact('exercises', 'metadata'))->render();
        } else {
            $html = $this->generateSimplePdfHtml($exercises, $metadata);
        }

        return response($html)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', 'inline; filename="exercicios-matematica-pdf.html"');
    }

    private function generateSimplePrintHtml(array $exercises, array $metadata): string
    {
        $html = '<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Exercícios de Matemática - Impressão</title>
    <style>
        @page { size: A4; margin: 2cm; }
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 20px; margin-bottom: 30px; }
        .exercise { margin-bottom: 20px; padding: 15px; border: 1px solid #ddd; }
        .exercise-number { font-weight: bold; margin-right: 10px; }
        .answer-line { border-bottom: 2px solid #333; min-width: 80px; display: inline-block; margin-left: 15px; }
        .solutions { page-break-before: always; }
        @media print { body { margin: 0; } }
    </style>
</head>
<body>
    <div class="header">
        <h1>📚 Exercícios de Matemática</h1>
        <p>Gerado em ' . date('d/m/Y H:i') . '</p>
    </div>';

        foreach ($exercises as $exercise) {
            $html .= '<div class="exercise">
                <span class="exercise-number">' . $exercise['exercise_number'] . '.</span>
                ' . $exercise['exercise'] . '
                <span class="answer-line"></span>
            </div>';
        }

        $html .= '<div class="solutions">
            <div class="header">
                <h2>✅ Respostas</h2>
            </div>';

        foreach ($exercises as $exercise) {
            $html .= '<div class="exercise">
                <span class="exercise-number">' . $exercise['exercise_number'] . '.</span>
                ' . $exercise['exercise'] . ' ' . $exercise['solution'] . '
            </div>';
        }

        $html .= '</div>
</body>
</html>';

        return $html;
    }

    private function generateSimplePdfHtml(array $exercises, array $metadata): string
    {
        // Similar ao método acima, mas otimizado para PDF
        return $this->generateSimplePrintHtml($exercises, $metadata);
    }

    private function generateTextContent(array $exercises, array $metadata): string
    {
        $content = "EXERCÍCIOS DE MATEMÁTICA\n";
        $content .= "========================\n\n";

        if (!empty($metadata)) {
            $content .= "Gerado em: " . $metadata['generated_at']->format('d/m/Y H:i:s') . "\n";
            $content .= "Total de exercícios: " . $metadata['total_exercises'] . "\n";
            $content .= "Operações: " . implode(', ', $metadata['operations']) . "\n";
            $content .= "Intervalo: " . $metadata['range']['min'] . " a " . $metadata['range']['max'] . "\n\n";
        }

        $content .= "EXERCÍCIOS:\n";
        $content .= "-----------\n\n";

        foreach ($exercises as $exercise) {
            $content .= sprintf(
                "%2d. %s _____\n",
                $exercise['exercise_number'],
                $exercise['exercise']
            );
        }

        $content .= "\n\nRESPOSTAS:\n";
        $content .= "----------\n\n";

        foreach ($exercises as $exercise) {
            $content .= sprintf(
                "%2d. %s %s\n",
                $exercise['exercise_number'],
                $exercise['exercise'],
                $exercise['solution']
            );
        }

        $content .= "\n\nGerado por " . config('app.name', 'MathX') . "\n";
        $content .= "© " . date('Y') . " - Todos os direitos reservados\n";

        return $content;
    }
}
