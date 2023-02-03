

ALTER TABLE `tb_accounts`
  ADD PRIMARY KEY (`account_id`);

ALTER TABLE `tb_records`
  ADD PRIMARY KEY (`record_id`);


ALTER TABLE `tb_accounts`
  MODIFY `account_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `tb_records`
  MODIFY `record_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
