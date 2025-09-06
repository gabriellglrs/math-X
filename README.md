# 🧮 Gerador de Exercícios Matemáticos

Uma aplicação web intuitiva desenvolvida em Laravel para gerar exercícios matemáticos personalizados. Ideal para professores, pais e estudantes que desejam praticar operações básicas de matemática.

## 📚 Objetivos de Aprendizado

Este projeto demonstra conceitos importantes do desenvolvimento web com Laravel:

- **MVC Architecture** - Separação clara entre Model, View e Controller
- **Form Validation** - Validação robusta de dados do usuário
- **Session Management** - Armazenamento temporário de dados
- **Blade Templating** - Sistema de templates do Laravel
- **Component-Based UI** - Componentes reutilizáveis do Blade
- **File Generation** - Criação dinâmica de arquivos (TXT, HTML, PDF)
- **Responsive Design** - Interface moderna e responsiva

## ✨ Funcionalidades

### 🎯 Geração de Exercícios
- **4 operações matemáticas**: Soma, Subtração, Multiplicação e Divisão
- **Configuração personalizada**: Define faixas numéricas (0-999)
- **Quantidade flexível**: Entre 5 e 50 exercícios por sessão
- **Dificuldade automática**: Classificação em Fácil, Médio e Difícil

### 📊 Interface Interativa
- **Verificação em tempo real**: Confere respostas instantaneamente
- **Barra de progresso**: Acompanha conclusão dos exercícios
- **Feedback visual**: Respostas corretas/incorretas com cores
- **Controles inteligentes**: Mostrar/ocultar respostas, reiniciar

### 📄 Exportação Múltipla
- **Impressão otimizada**: Layout especial para impressão
- **Exportação TXT**: Arquivo de texto simples
- **Geração PDF**: Formato profissional com gabarito
- **Preservação de dados**: Mantém exercícios na sessão

## 🏗️ Estrutura do Projeto

```
math-exercise-generator/
├── app/
│   ├── Http/Controllers/
│   │   ├── Controller.php          # Controller base
│   │   └── MainController.php      # Lógica principal
│   ├── Providers/
│   │   └── AppServiceProvider.php  # Configurações da aplicação
│   └── View/Components/            # Componentes Blade
│       ├── footer.php
│       └── logo.php
├── resources/
│   ├── css/
│   │   └── app.css                 # Estilos Tailwind
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views/                      # Templates Blade
│       ├── components/
│       │   ├── footer.blade.php
│       │   └── logo.blade.php
│       ├── home.blade.php          # Página inicial
│       ├── operations.blade.php    # Página de exercícios
│       ├── print-exercises.blade.php
│       └── pdf-exercises.blade.php
└── routes/
    ├── web.php                     # Rotas da aplicação
    └── console.php                 # Comandos Artisan
```

## 🚀 Como Executar

### Pré-requisitos

- PHP 8.1+ 
- Composer
- Node.js e NPM (para assets)

### 1. Clone o repositório

```bash
git clone <seu-repositorio>
cd math-exercise-generator
```

### 2. Instale as dependências

```bash
# Dependências PHP
composer install

# Dependências JavaScript
npm install
```

### 3. Configure o ambiente

```bash
# Copie o arquivo de configuração
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate
```

### 4. Compile os assets (opcional)

```bash
npm run dev
# ou para produção
npm run build
```

### 5. Inicie o servidor

```bash
php artisan serve
```

A aplicação estará disponível em `http://localhost:8000`

## 🎮 Como Usar

### 1. Configuração Inicial
1. Acesse a página inicial
2. Selecione as operações desejadas (Soma, Subtração, Multiplicação, Divisão)
3. Configure o intervalo de números (0-999)
4. Escolha a quantidade de exercícios (5-50)

### 2. Resolução dos Exercícios
1. Complete os exercícios digitando as respostas
2. Acompanhe seu progresso na barra superior
3. Use os botões para mostrar/ocultar respostas
4. Reinicie quando necessário

### 3. Exportação e Impressão
- **Imprimir**: Use o botão "Imprimir" para versão física
- **Exportar TXT**: Baixe arquivo texto simples
- **Gerar PDF**: Crie versão profissional com gabarito

## 🛠️ Tecnologias Utilizadas

### Backend
- **[Laravel 11](https://laravel.com/)** - Framework PHP moderno
- **[PHP 8.1+](https://www.php.net/)** - Linguagem de programação
- **[Carbon](https://carbon.nesbot.com/)** - Manipulação de datas

### Frontend
- **[Blade](https://laravel.com/docs/blade)** - Sistema de templates
- **[Bootstrap 5](https://getbootstrap.com/)** - Framework CSS
- **[Tailwind CSS](https://tailwindcss.com/)** - Utilitários CSS
- **JavaScript Vanilla** - Interatividade

### Recursos
- **Session Storage** - Armazenamento temporário
- **Form Validation** - Validação de formulários
- **File Generation** - Geração dinâmica de arquivos
- **Responsive Design** - Design responsivo

## 📋 Principais Rotas

```php
// Página inicial - configuração
GET  /

// Gerar exercícios
POST /generate-exercises

// Imprimir exercícios
GET  /print-exercises

// Exportar para TXT
GET  /export-exercises

// Download PDF
GET  /download-pdf
```

## 🎯 Funcionalidades Detalhadas

### 🧠 Sistema de Dificuldade

**Soma:**
- Fácil: Resultado ≤ 20
- Médio: Resultado ≤ 100
- Difícil: Resultado > 100

**Subtração:**
- Fácil: Números ≤ 20 e ≤ 10
- Médio: Números ≤ 100 e ≤ 50
- Difícil: Números maiores

**Multiplicação:**
- Fácil: Números ≤ 5x5 ou tabuada do 1
- Médio: Números ≤ 12x12
- Difícil: Números maiores

**Divisão:**
- Fácil: Dividendo ≤ 50, divisor ≤ 10
- Médio: Dividendo ≤ 200, divisor ≤ 20
- Difícil: Números maiores

### 📊 Validações Implementadas

```php
// Operações: Pelo menos uma deve ser selecionada
'check_sum' => 'required_without_all:check_subtraction,check_multiplication,check_division'

// Números: Faixa válida e ordenada
'number_one' => 'required|integer|min:0|max:999|lt:number_two'
'number_two' => 'required|integer|min:0|max:999'

// Exercícios: Quantidade controlada
'number_exercises' => 'required|integer|min:1|max:50'
```

### 🎨 Design Moderno

- **Gradientes suaves** e cores harmoniosas
- **Cards interativos** com hover effects
- **Animações CSS** para melhor UX
- **Layout responsivo** para todos dispositivos
- **Tipografia clara** e legível

## 📚 Conceitos Educacionais Demonstrados

### 1. **Arquitetura MVC**
- **Model**: Lógica de dados (arrays de exercícios)
- **View**: Templates Blade responsivos
- **Controller**: `MainController` com todas as operações

### 2. **Validação Robusta**
- Validação server-side com Laravel
- Mensagens personalizadas em português
- Validação condicional (pelo menos uma operação)

### 3. **Gerenciamento de Estado**
- Uso de sessões para persistir exercícios
- Metadata completa dos exercícios gerados
- Estado preservado entre páginas

### 4. **Componentes Reutilizáveis**
- Componentes Blade para header e footer
- Estrutura modular e organizizada

### 5. **Geração Dinâmica de Conteúdo**
- Templates para diferentes formatos de saída
- Geração de HTML otimizado para impressão
- Criação de arquivos para download

## 🔧 Personalização

### Adicionando Novas Operações

1. **Atualizar o Controller:**
```php
// Adicionar nova validação
'check_potencia' => 'required_without_all:...'

// Adicionar ao array de operações
if ($request->check_potencia) $operations[] = 'potencia';

// Adicionar novo case no switch
case 'potencia':
    $exercise = "$number1 ^ $number2 =";
    $solution = pow($number1, $number2);
    break;
```

2. **Atualizar a View:**
```html
<div class="operation-card" data-operation="potencia">
    <div class="text-center">
        <div class="operation-icon">⬆️</div>
        <h6 class="fw-bold">Potenciação</h6>
    </div>
    <input type="checkbox" name="check_potencia" class="d-none">
</div>
```

### Modificando Faixas de Dificuldade

Edite o método `calculateDifficulty()` no `MainController`:

```php
private function calculateDifficulty(string $operation, int $number1, int $number2): string
{
    // Personalizar critérios aqui
    switch ($operation) {
        case 'sum':
            // Modificar limites conforme necessário
            if ($sum <= 10) return 'Muito Fácil';
            if ($sum <= 50) return 'Fácil';
            // ...
    }
}
```

## 🔄 Próximas Melhorias

Para expandir o projeto, considere implementar:

- [ ] **Banco de dados** para histórico de exercícios
- [ ] **Autenticação** para múltiplos usuários
- [ ] **Relatórios** de desempenho e estatísticas
- [ ] **Temas** personalizáveis na interface
- [ ] **API REST** para integração com outras aplicações
- [ ] **PWA** para uso offline
- [ ] **Exercícios de frações** e decimais
- [ ] **Múltipla escolha** como opção
- [ ] **Cronômetro** para exercícios com tempo
- [ ] **Gamificação** com pontos e conquistas

## 🤝 Contribuindo

1. Faça fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/NovaFuncionalidade`)
3. Commit suas mudanças (`git commit -am 'Adiciona nova funcionalidade'`)
4. Push para a branch (`git push origin feature/NovaFuncionalidade`)
5. Crie um Pull Request

## 🐛 Reportando Problemas

Encontrou um bug? Abra uma [issue](../../issues) com:
- Descrição detalhada do problema
- Passos para reproduzir
- Comportamento esperado vs atual
- Screenshots (se aplicável)

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 🙏 Agradecimentos

- **Laravel Team** - Framework excepcional
- **Bootstrap Team** - Components UI
- **Tailwind CSS** - Utility classes
- **Comunidade PHP** - Suporte e inspiração

## 📞 Suporte

- 📧 Email: [seu-email@exemplo.com]
- 🐛 Issues: [GitHub Issues](../../issues)
- 💬 Discussões: [GitHub Discussions](../../discussions)

---

**Feito com ❤️ para educação matemática**

*Este projeto foi desenvolvido com foco educacional, demonstrando boas práticas de desenvolvimento web com Laravel e criando uma ferramenta útil para o ensino de matemática.*
