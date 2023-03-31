CREATE TABLE `tarefas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `finalizado` tinyint(1) NOT NULL DEFAULT 0
);

ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tarefas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;
