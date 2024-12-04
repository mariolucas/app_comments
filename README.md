
# Projeto seleção Betalabs

## Sobre os requisitos do sistema

- O sistema deverá gerenciar os usuários, permitindo-os se cadastrar e editar seu cadastro;
Ao acessar o sistema no topo tem um menu "Cadastre-se" onde o visitante poderá acessar o formulário de cadastro.

- O sistema poderá autenticar o usuário através do e-mail e senha do usuário e, nas outras requisições, utilizar apenas um token de identificação;

Na tela /login o usuário já devidamente cadastrado poderá acessar o sistema e interagir enviando mensagens.

- O sistema deverá retornar comentários a todos que o acessarem, porém deverá permitir inserir comentários apenas a usuários autenticados;

Na home terá a lista de todos os comentários feitos, mas ao se logar o usuário terá a possibilidade de comentar através do menu "Comentar"

- O sistema deverá retornar qual é o autor do comentário e dia e horário da postagem;

Em cada comentário tem o nome do autor e a data no topo do card de comentário.

- O sistema deverá permitir o usuário editar os próprios comentários (exibindo a data de criação do comentário e data da última edição);

No menu "meus comentários" terá a lista de todos os comentários com a possibilidade de alteração, possui a data de criação, mas só irá mostrar a data da edição só quando realmente for feita uma edição do comentário.

- O sistema deverá permitir o usuário excluir os próprios comentários;
Ainda em "meus comentários" existe um ícone para a exclusão do comenário.

- O sistema deverá criptografar a senha do usuário;
A senha do usuário está sendo criptografada.


## Observação

No arquivo .ENV coloquei duas variáveis APP_URL e API_URL, para as rotas web e api.