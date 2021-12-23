CREATE TABLE `usuario` (
    `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` text NOT NULL,
    `email` text NOT NULL,
    `senha` text NOT NULL
);

CREATE TABLE `conversa` (
    `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_remetente` text NOT NULL,
    `id_destinatario` text NOT NULL,
    `mensagem` text NOT NULL
);