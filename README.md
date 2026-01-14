API em PHP para Simulação de Compra na Rocketseat
Desenvolvido por Diego
GitHub: @DIDIAC68

📌 Descrição
Esta API em PHP utiliza cURL para simular requisições ao site da Rocketseat, realizando uma tentativa de compra de curso via cartão de crédito.

A finalidade principal é educacional, com foco em estudo e testes de integração com sistemas de pagamento e automação de requisições web.

🚀 Como Usar
Para utilizar a API, é necessário acessar o script PHP com os parâmetros do cartão diretamente na URL, como no exemplo:

rocket.php?lista=1111111111111111|07|2033|899
📥 Parâmetro obrigatório
lista: Dados do cartão no formato:

número_do_cartão|mês|ano|cvv
Exemplo válido:

1111111111111111|07|2033|899
Caso qualquer um dos campos esteja ausente ou mal formatado, a API não funcionará corretamente.

📦 Retorno da API
A resposta será retornada em JSON, com o resultado da tentativa de requisição de compra.

⚠️ Aviso Legal
Esta aplicação foi desenvolvida apenas para fins de aprendizado e testes.
Não me responsabilizo por qualquer uso indevido deste código.
