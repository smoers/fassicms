-- fassi_cms_03.view_clocking_extended source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `fassi_cms_03`.`view_clocking_extended` AS
select
    `fassi_cms_03`.`technicians`.`lastname` AS `lastname`,
    `fassi_cms_03`.`technicians`.`firstname` AS `firstname`,
    concat(`fassi_cms_03`.`technicians`.`firstname`, ' ', `fassi_cms_03`.`technicians`.`lastname`) AS `fullname`,
    `fassi_cms_03`.`clockings`.`id` AS `id`,
    `fassi_cms_03`.`clockings`.`date` AS `date`,
    `fassi_cms_03`.`clockings`.`start_date` AS `start_date`,
    `fassi_cms_03`.`clockings`.`stop_date` AS `stop_date`,
    `fassi_cms_03`.`clockings`.`technician_id` AS `technician_id`,
    `fassi_cms_03`.`clockings`.`user_id` AS `user_id`,
    `fassi_cms_03`.`clockings`.`created_at` AS `created_at`,
    `fassi_cms_03`.`clockings`.`updated_at` AS `updated_at`,
    `fassi_cms_03`.`clockings`.`worksheet_id` AS `worksheet_id`,
    date_format(`fassi_cms_03`.`clockings`.`start_date`, '%d-%m-%Y') AS `start_date_d`,
    date_format(`fassi_cms_03`.`clockings`.`start_date`, '%d-%m-%Y') AS `stop_date_d`,
    date_format(`fassi_cms_03`.`clockings`.`start_date`, '%H:%i') AS `start_time`,
    date_format(`fassi_cms_03`.`clockings`.`stop_date`, '%H:%i') AS `stop_time`,
    sec_to_time(timestampdiff(SECOND, `fassi_cms_03`.`clockings`.`start_date`, `fassi_cms_03`.`clockings`.`stop_date`)) AS `diff`
from
    (`fassi_cms_03`.`clockings`
left join `fassi_cms_03`.`technicians` on
    (`fassi_cms_03`.`clockings`.`technician_id` = `fassi_cms_03`.`technicians`.`id`));
    
-- fassi_cms_03.view_clockings_by_day source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `fassi_cms_03`.`view_clockings_by_day` AS
select
    `vce`.`worksheet_id` AS `worksheet_id`,
    `vce`.`date` AS `date`,
    sec_to_time(sum(time_to_sec(`vce`.`diff`))) AS `time`
from
    `fassi_cms_03`.`view_clocking_extended` `vce`
group by
    `vce`.`worksheet_id`,
    `vce`.`date`;
    
-- fassi_cms_03.view_clockings_details_correct source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `fassi_cms_03`.`view_clockings_details_correct` AS
select
    `cd`.`id` AS `id`,
    cast(`cd`.`date_time` as date) AS `date`,
    cast(`cd`.`date_time` as time) AS `time`,
    `cd`.`action` AS `action`,
    `cd`.`status` AS `status`,
    `cd`.`worksheet_id` AS `worksheet_id`,
    `cd`.`technician_id` AS `technician_id`,
    `cd`.`user_id` AS `user_id`,
    `cd`.`created_at` AS `created_at`,
    `cd`.`updated_at` AS `updated_at`,
    `w`.`number` AS `w_number`,
    `t`.`number` AS `t_number`,
    concat_ws(' ', `t`.`firstname`, `t`.`lastname`) AS `technician`
from
    ((`fassi_cms_03`.`clockings_details` `cd`
left join `fassi_cms_03`.`worksheets` `w` on
    (`cd`.`worksheet_id` = `w`.`id`))
left join `fassi_cms_03`.`technicians` `t` on
    (`cd`.`technician_id` = `t`.`id`))
where
    `cd`.`date_time` < curdate();
    
-- fassi_cms_03.view_partmetadatas_reassort source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `fassi_cms_03`.`view_partmetadatas_reassort` AS
select
    `PM`.`id` AS `id`,
    `PM`.`part_number` AS `part_number`,
    `PM`.`description` AS `description`,
    `PM`.`enabled` AS `enabled`,
    `PM`.`electrical_part` AS `electrical_part`,
    `PM`.`bar_code` AS `bar_code`,
    `PM`.`created_at` AS `created_at`,
    `PM`.`updated_at` AS `updated_at`,
    `PM`.`reassort_level` AS `reassort_level`,
    `PM`.`user_id` AS `user_id`,
    `ST`.`qty` AS `qty`
from
    (`fassi_cms_03`.`partmetadatas` `PM`
left join (
    select
        `fassi_cms_03`.`stores`.`partmetadata_id` AS `partmetadata_id`,
        sum(`fassi_cms_03`.`stores`.`qty`) AS `qty`
    from
        `fassi_cms_03`.`stores`
    group by
        `fassi_cms_03`.`stores`.`partmetadata_id`) `ST` on
    (`PM`.`id` = `ST`.`partmetadata_id`))
where
    `PM`.`reassort_level` >= `ST`.`qty`
    and `PM`.`enabled` = 1;
    
-- fassi_cms_03.view_parts_signed_values source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `fassi_cms_03`.`view_parts_signed_values` AS
select
    `fassi_cms_03`.`parts`.`id` AS `id`,
    `fassi_cms_03`.`parts`.`part_number` AS `part_number`,
    `fassi_cms_03`.`parts`.`description` AS `description`,
    `fassi_cms_03`.`parts`.`qty` AS `qty`,
    `fassi_cms_03`.`parts`.`price` AS `price`,
    `fassi_cms_03`.`parts`.`year` AS `year`,
    `fassi_cms_03`.`parts`.`user_id` AS `user_id`,
    `fassi_cms_03`.`parts`.`created_at` AS `created_at`,
    `fassi_cms_03`.`parts`.`updated_at` AS `updated_at`,
    `fassi_cms_03`.`parts`.`worksheet_id` AS `worksheet_id`,
    `fassi_cms_03`.`parts`.`bar_code` AS `bar_code`,
    `fassi_cms_03`.`parts`.`type` AS `type`,
    if(`fassi_cms_03`.`parts`.`type` = 'O',
    `fassi_cms_03`.`parts`.`qty`,
    `fassi_cms_03`.`parts`.`qty` * -1) AS `qty_signed`,
    `fassi_cms_03`.`parts`.`price` AS `unit_price_signed`,
    if(`fassi_cms_03`.`parts`.`type` = 'O',
    `fassi_cms_03`.`parts`.`qty` * `fassi_cms_03`.`parts`.`price`,
    `fassi_cms_03`.`parts`.`qty` * `fassi_cms_03`.`parts`.`price` * -1) AS `total_price_signed`
from
    `fassi_cms_03`.`parts`;
    
-- fassi_cms_03.view_parts_sum_outs source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `fassi_cms_03`.`view_parts_sum_outs` AS
select
    `fassi_cms_03`.`parts`.`worksheet_id` AS `worksheet_id`,
    `fassi_cms_03`.`parts`.`part_number` AS `part_number`,
    `fassi_cms_03`.`parts`.`bar_code` AS `bar_code`,
    sum(`fassi_cms_03`.`parts`.`qty`) AS `o_qty`,
    sum(`fassi_cms_03`.`parts`.`qty`) * -1 AS `r_qty`,
    sum(`fassi_cms_03`.`parts`.`price`) AS `o_price`,
    sum(`fassi_cms_03`.`parts`.`price`) * -1 AS `r_price`
from
    `fassi_cms_03`.`parts`
where
    `fassi_cms_03`.`parts`.`type` = 'O'
group by
    `fassi_cms_03`.`parts`.`worksheet_id`,
    `fassi_cms_03`.`parts`.`part_number`,
    `fassi_cms_03`.`parts`.`bar_code`;
    
-- fassi_cms_03.view_parts_sum_reassortements source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `fassi_cms_03`.`view_parts_sum_reassortements` AS
select
    `fassi_cms_03`.`parts`.`worksheet_id` AS `worksheet_id`,
    `fassi_cms_03`.`parts`.`part_number` AS `part_number`,
    `fassi_cms_03`.`parts`.`bar_code` AS `bar_code`,
    sum(`fassi_cms_03`.`parts`.`qty`) * -1 AS `o_qty`,
    sum(`fassi_cms_03`.`parts`.`qty`) AS `r_qty`,
    sum(`fassi_cms_03`.`parts`.`price`) * -1 AS `o_price`,
    sum(`fassi_cms_03`.`parts`.`price`) AS `r_price`
from
    `fassi_cms_03`.`parts`
where
    `fassi_cms_03`.`parts`.`type` = 'R'
group by
    `fassi_cms_03`.`parts`.`worksheet_id`,
    `fassi_cms_03`.`parts`.`part_number`,
    `fassi_cms_03`.`parts`.`bar_code`;
    
-- fassi_cms_03.view_parts_total source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `fassi_cms_03`.`view_parts_total` AS
select
    `view_parts_signed_values`.`worksheet_id` AS `worksheet_id`,
    `view_parts_signed_values`.`part_number` AS `part_number`,
    `view_parts_signed_values`.`bar_code` AS `bar_code`,
    sum(`view_parts_signed_values`.`qty_signed`) AS `qty_total`,
    `view_parts_signed_values`.`price` AS `price`,
    sum(`view_parts_signed_values`.`total_price_signed`) AS `price_total`
from
    `fassi_cms_03`.`view_parts_signed_values`
group by
    `view_parts_signed_values`.`worksheet_id`,
    `view_parts_signed_values`.`part_number`,
    `view_parts_signed_values`.`bar_code`;
    
-- fassi_cms_03.view_worksheets_customers_cranes source

CREATE OR REPLACE
ALGORITHM = UNDEFINED VIEW `fassi_cms_03`.`view_worksheets_customers_cranes` AS
select
    `w`.`id` AS `id`,
    `w`.`number` AS `number`,
    `w`.`date` AS `date`,
    year(`w`.`date`) AS `year`,
    `w`.`validated` AS `validated`,
    `w`.`validated_date` AS `validated_date`,
    `w`.`warranty` AS `warranty`,
    `tc`.`serial` AS `serial`,
    `tc`.`plate` AS `plate`,
    `c`.`name` AS `name`,
    `w`.`truckscrane_id` AS `truckscrane_id`
from
    ((`fassi_cms_03`.`worksheets` `w`
left join `fassi_cms_03`.`truckscranes` `tc` on
    (`w`.`truckscrane_id` = `tc`.`id`))
left join `fassi_cms_03`.`customers` `c` on
    (`tc`.`customer_id` = `c`.`id`));   
    
   