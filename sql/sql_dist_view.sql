delete from orders;
delete from cart_order;

insert into orders (order_id, order_date, status) values
	(1, now(), 'inprogress');
    
insert into cart_order (order_id, cart_id) values
	(1, 1),
    (1, 2),
    (1, 3),
    (1, 4);