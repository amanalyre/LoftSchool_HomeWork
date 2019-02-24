INSERT INTO users
SET us_name = 'Врушин Тлад', us_email = 'tlad2018@test.com', create_date = '2018-05-07', us_phone = '+7 999 999-99-99';


INSERT INTO orders
SET create_date = '2018-05-05', street = 'Тверская', house = '1', building = 'a', apartment = 22, floor = 3,
  description = 'Позвоните от консъержа', payment_type = true, callback = false, user_id = 1;

