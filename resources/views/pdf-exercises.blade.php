<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercícios de Matemática - PDF</title>

    <style>
        @page {
            size: A4;
            margin: 1.5cm;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            line-height: 1.5;
            color: #333;
            background: white;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            font-size: 2.2em;
            color: #007bff;
            font-weight: bold;
        }

        .header .subtitle {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 1.1em;
        }

        .info-box {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 0.9em;
        }

        .info-box h3 {
            margin: 0 0 8px 0;
            color: #495057;
            font-size: 1.1em;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .exercises-section {
            margin-bottom: 30px;
        }

        .exercises-table {
            width: 100%;
            border-collapse: collapse;
        }

        .exercises-table td {
            padding: 12px;
            vertical-align: top;
            width: 50%;
        }

        .exercise-box {
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 10px;
            background: #fafafa;
            min-height: 60px;
        }

        .exercise-number {
            background: #007bff;
            color: white;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9em;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .exercise-text {
            font-size: 1.3em;
            font-weight: 500;
            color: #333;
        }

        .answer-space {
            border-bottom: 2px solid #333;
            min-width: 70px;
            display: inline-block;
            margin-left: 10px;
            height: 20px;
        }

        .solutions-page {
            page-break-before: always;
        }

        .solutions-header {
            text-align: center;
            border-bottom: 2px solid #28a745;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .solutions-header h2 {
            margin: 0;
            color: #28a745;
            font-size: 1.8em;
        }

        .solutions-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .solution-box {
            border: 1px solid #28a745;
            border-radius: 4px;
            padding: 8px;
            text-align: center;
            background: #f0f8f0;
            font-size: 0.9em;
        }

        .solution-number {
            font-weight: bold;
            color: #155724;
        }

        .solution-answer {
            color: #28a745;
            font-weight: bold;
            margin-top: 3px;
        }

        .footer {
            position: fixed;
            bottom: 0.5cm;
            left: 1.5cm;
            right: 1.5cm;
            text-align: center;
            font-size: 0.8em;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 8px;
        }

        .page-number:after {
            content: "Página " counter(page);
        }

        @media screen {
            body {
                max-width: 21cm;
                margin: 20px auto;
                padding: 20px;
                box-shadow: 0 0 15px rgba(0,0,0,0.1);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Exercícios de Matemática</h1>
            <div class="subtitle">Complete todos os exercícios com atenção</div>
        </div>

        @if(isset($metadata))
        <div class="info-box">
            <h3>Informações dos Exercícios</h3>
            <div class="info-row">
                <span><strong>Data:</strong> {{ $metadata['generated_at']->format('d/m/Y H:i') }}</span>
                <span><strong>Total:</strong> {{ $metadata['total_exercises'] }} exercícios</span>
            </div>
            <div class="info-row">
                <span><strong>Operações:</strong> {{ implode(', ', array_map('ucfirst', $metadata['operations'])) }}</span>
                <span><strong>Números:</strong> {{ $metadata['range']['min'] }} a {{ $metadata['range']['max'] }}</span>
            </div>
        </div>
        @endif

        <div class="exercises-section">
            <table class="exercises-table">
                @for($i = 0; $i < count($exercises); $i += 2)
                    <tr>
                        <td>
                            <div class="exercise-box">
                                <div class="exercise-number">{{ $exercises[$i]['exercise_number'] }}</div>
                                <div class="exercise-text">
                                    {{ $exercises[$i]['exercise'] }}
                                    <span class="answer-space"></span>
                                </div>
                            </div>
                        </td>
                        @if(isset($exercises[$i + 1]))
                            <td>
                                <div class="exercise-box">
                                    <div class="exercise-number">{{ $exercises[$i + 1]['exercise_number'] }}</div>
                                    <div class="exercise-text">
                                        {{ $exercises[$i + 1]['exercise'] }}
                                        <span class="answer-space"></span>
                                    </div>
                                </div>
                            </td>
                        @else
                            <td></td>
                        @endif
                    </tr>
                @endfor
            </table>
        </div>
    </div>

    <div class="solutions-page">
        <div class="container">
            <div class="solutions-header">
                <h2>Gabarito</h2>
            </div>

            <div class="solutions-grid">
                @foreach($exercises as $exercise)
                    <div class="solution-box">
                        <div class="solution-number">{{ $exercise['exercise_number'] }}.</div>
                        <div class="solution-answer">{{ $exercise['solution'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="footer">
        <div>
            {{ config('app.name', 'MathX') }} © {{ date('Y') }} |
            Gerado em {{ date('d/m/Y H:i') }} |
            <span class="page-number"></span>
        </div>
    </div>
</body>
</html>
