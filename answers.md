# Ответы на SQL-тренажёр

Взято из: https://sites.google.com/site/addsharming/otvety-na-zadaci-po-sql

Дополнено своими ответами.

## Задание: 1

### Найдите номер модели, скорость и размер жесткого диска для всех ПК стоимостью менее 500 дол. Вывести: model, speed и hd 
```
SELECT model ,  speed, hd
FROM pc
WHERE price < 500  
```
## Задание: 2
### Найдите производителей принтеров. Вывести: maker
```
SELECT maker from  product
WHERE product.type = 'printer'
GROUP BY maker  
```
## Задание: 3
### Найдите номер модели, объем памяти и размеры экранов ПК-блокнотов, цена которых превышает 1000 дол.
```
SELECT model , ram ,  screen
FROM laptop
WHERE price > 1000  
```
## Задание: 4
### Найдите все записи таблицы Printer для цветных принтеров.
```
SELECT *
FROM printer
WHERE color = 'y'
```
## Задание: 5
### Найдите номер модели, скорость и размер жесткого диска ПК, имеющих 12x или 24x CD и цену менее 600 дол.
```
SELECT model ,speed , hd
FROM pc
WHERE (cd = '12x' or cd = '24x')
and price < 600  
```
## Задание: 6
### Укажите производителя и скорость для тех ПК-блокнотов, которые имеют жесткий диск объемом не менее 10 Гбайт.
```
SELECT maker, speed
FROM Product
INNER JOIN Laptop
ON Product.model = Laptop.model   
WHERE hd >= 10  
```
## Задание: 7
### Найдите номера моделей и цены всех продуктов (любого типа), выпущенных производителем B (латинская буква).
```
SELECT laptop.model , laptop.price
FROM laptop
INNER JOIN product
ON laptop.model = product.model  
WHERE product.maker= 'B' 
UNION
SELECT pc.model , pc.price
FROM pc
INNER JOIN product
ON pc.model = product.model  
WHERE product.maker= 'B' 
UNION
SELECT printer.model , printer.price
FROM printer
INNER JOIN product
ON printer.model = product.model  
WHERE product.maker= 'B' 
```
## Задание: 8 

### Найдите производителя, выпускающего ПК, но не ПК-блокноты.
```
SELECT maker
FROM product
WHERE type='PC'
and maker
NOT IN
( SELECT maker FROM product WHERE type = 'Laptop')
GROUP BY maker
```
## Задание: 9 

### Найдите производителей ПК с процессором не менее 450 Мгц. Вывести: Maker
```
Select maker
from pc
inner join product
on pc.model = product.model
where speed >= 450 
group by maker 
```
## Задание: 10 
### Найдите принтеры, имеющие самую высокую цену. Вывести: model, price
```
select model, price
from printer
where price = (select max(price) from printer)   
```
## Задание: 11 
### Найдите среднюю скорость ПК.
```
select avg (speed)
from pc  
```
## Задание: 12 
### Найдите среднюю скорость ПК-блокнотов, цена которых превышает 1000 дол.
```
Select avg(speed)
From laptop 
Where price > 1000 
```
## Задание: 13 

### Найдите среднюю скорость ПК, выпущенных производителем A
```
Select avg(speed)
from pc
inner join product
on pc.model= product.model
where maker = 'A'   
group by maker 
```
## Задание: 14 

### Для каждого значения скорости найдите среднюю стоимость ПК с такой же скоростью процессора. Вывести: скорость, средняя цена

Select speed , avg(price) from pc group by speed  

## Задание: 15

### Найти производителей, которые выпускают более одной модели, при этом все выпускаемые производителем модели являются продуктами одного типа.Вывести: maker, type

select maker ,type from Product 

where maker in ( select maker  

from ( select maker,type from Product group by maker,type ) x  

group by maker having count(*)=1 )  

group by maker,type having count(*)>1 

## Задание: 16

### Найдите размеры жестких дисков, совпадающих у двух и более PC. Вывести: HD

Select hd  from pc group by hd having count(model)>1  

## Задание: 17

### Найдите пары моделей PC, имеющих одинаковые скорость и RAM. В результате каждая пара указывается только один раз, т.е. (i,j), но не (j,i), Порядок вывода: модель с большим номером, модель с меньшим номером, скорость и RAM.

SELECT DISTINCT B.model AS pc1.model, A.model AS pc2.model, A.speed, A.ram

FROM PC AS A, PC B

WHERE A.speed = B.speed AND A.ram = B.ram and A.model < B.model

## Задание: 18

### Найдите модели ПК-блокнотов, скорость которых меньше скорости любого из ПК. Вывести: type, model, speed

Select distinct type,laptop.model,speed from laptop inner join product on laptop.model= product.model  

where speed < (select MIN(speed) from pc)  

## Задание: 19

### Найдите производителей самых дешевых цветных принтеров. Вывести: maker, price

SELECT DISTINCT maker,price  FROM printer inner JOIN product ON printer.model= product.model  

WHERE price = (select min(price)from printer where color = 'y' ) and color = 'y'  

## Задание: 20

### Для каждого производителя найдите средний размер экрана выпускаемых им ПК-блокнотов. Вывести: maker, средний размер экрана.

Select maker ,avg(screen)as Avg_screen 

from laptop inner join product on laptop.model =  product.model group by maker  

## Задание: 21

### Найдите производителей, выпускающих по меньшей мере три различных модели ПК. Вывести: Maker, число моделей

Select maker , count(model) as Count_Model from product where type = 'pc' group by maker 

having count(model) >= 3  

## Задание: 22

### Найдите максимальную цену ПК, выпускаемых каждым производителем. Вывести: maker, максимальная цена.

Select maker , max(price)as Max_price from pc inner join product on pc.model= product.model  

group by maker 

## Задание: 23

### Для каждого значения скорости ПК, превышающего 600 МГц, определите среднюю цену ПК с такой же скоростью. Вывести: speed, средняя цена.

Select speed , avg(price) as Avg_price from pc  where speed > 600 group by speed  

## Задание: 24

### Найдите производителей, которые производили бы как ПКсо скоростью не менее 750 МГц, так и ПК-блокноты со скоростью не менее 750 МГц.Вывести: Maker

select distinct maker  from pc inner join product on pc.model = product.model  

where pc.speed >= 750 and maker in (select  maker  

from laptop inner join product on laptop.model = product.model where laptop.speed >= 750)  

## Задание: 25

### Перечислите номера моделей любых типов, имеющих самую высокую цену по всей имеющейся в базе данных продукции.

SELECT model FROM( 

SELECT distinct model, price FROM laptop WHERE laptop.price = (SELECT MAX(price) FROM laptop)  

UNION 

SELECT distinct model, price FROM pc WHERE pc.price = (SELECT MAX(price) FROM pc)  

UNION 

SELECT distinct model, price FROM printer WHERE printer.price = (SELECT MAX(price) FROM printer)  

) as t 

WHERE t.price=(SELECT MAX(price) FROM ( 

SELECT distinct price FROM laptop WHERE laptop.price = (SELECT MAX(price) FROM laptop)  

UNION 

SELECT distinct price FROM pc WHERE pc.price = (SELECT MAX(price) FROM pc)  

UNION 

SELECT distinct price FROM printer WHERE printer.price = (SELECT MAX(price) FROM printer)  

) as t1 )    

## Задание: 26

### Найдите производителей принтеров, которые производят ПК с наименьшим объемом RAM и с самым быстрым процессором среди всех ПК,имеющих наименьший объем RAM. Вывести: Maker

SELECT distinct product.maker FROM product WHERE product.type='Printer'  

INTERSECT 

SELECT distinct product.maker FROM product INNER JOIN pc ON pc.model=product.model  

WHERE product.type='PC' AND pc.ram=(SELECT MIN(ram) FROM pc)  

AND pc.speed = (SELECT MAX(speed) FROM (SELECT distinct speed FROM pc 

WHERE pc.ram=(SELECT MIN(ram) FROM pc)) as t) 

## Задание: 27

### Найдите среднюю цену ПК и ПК-блокнотов, выпущенных производителем A (латинская буква). Вывести: одна общая средняя цена.

SELECT t1.c/t1.d FROM( SELECT SUM(t.a) as c, SUM(t.b) as d FROM(  

SELECT SUM(pc.price) as a, COUNT(pc.code) as b FROM pc 

INNER JOIN product ON pc.model=product.model WHERE product.maker='A'  

UNION 

SELECT SUM(laptop.price) as a, COUNT(laptop.code) as b FROM laptop 

INNER JOIN product ON laptop.model=product.model WHERE product.maker='A') as t) as t1  

## Задание: 28

### Найдите средний размер диска ПК каждого из тех производителей, которые выпускают и принтеры. Вывести: maker, средний размер HD.

select maker,avg(hd)  from product inner join pc on product.model=pc.model   

where maker in(select maker  from product  where type='printer')  group by maker  

## Задание: 29

### Найдите средний размер диска ПК (одно значение для всех) тех производителей, которые выпускают и принтеры. Вывести: средний размер HD

select avg(hd)  from product inner join pc on product.model = pc.model   

where maker in(select maker from product where type='printer') 

## Задание: 30

### В предположении, что приход и расход денег на каждом пункте приема фиксируется не чаще одного раза в день [т.е. первичный ключ (пункт, дата)], написать запрос с выходными данными (пункт, дата, приход, расход). Использовать таблицы Income_o и Outcome_o.

select t.point, t.date, SUM(t.inc), sum(t.out) from( select point, date, inc, null as out from Income_o  

Union 

select point, date, null as inc, Outcome_o.out from Outcome_o) as t group by t.point, t.date  

## Задание: 31

### В предположении, что приход и расход денег на каждом пункте приема фиксируется произвольное число раз (первичным ключом в таблицах является столбец code), требуется получить таблицу, в которой каждому пункту за каждую дату выполнения операций будет соответствовать одна строка.Вывод: point, date, суммарный расход пункта за день (out), суммарный приход пункта за день (inc).Отсутствующие значения считать неопределенными (NULL).

select point, date, SUM(sum_out), SUM(sum_inc) 

from( select point, date, SUM(inc) as sum_inc, null as sum_out from Income Group by point, date  

Union 

select point, date, null as sum_inc, SUM(out) as sum_out from Outcome Group by point, date ) as t  

group by point, date order by point  

## Задание: 32

### Для классов кораблей, калибр орудий которых не менее 16 дюймов, укажите класс и страну.

Select class , country from classes where bore >= 16  

## Задание: 33 > Вариант 1

### Одной из характеристик корабля является половина куба калибра его главных орудий (mw). С точностью до 2 десятичных знаков определите среднее значение mw для кораблей каждой страны, у которой есть корабли в базе данных.

Select country, cast(avg((power(bore,3)/2)) as numeric(6,2)) as weight 

from (select country, classes.class, bore, name from classes left join ships on classes.class=ships.class  

union all 

select distinct country, class, bore, ship from classes t1 left join outcomes t2 on t1.class=t2.ship  

where ship=class and ship not in (select name from ships) ) a  

where name!='null' group by country   

## Задание: 33  > Вариант 2  

select country, cast(avg(bore*bore*bore/2) AS NUMERIC(6,2)) as mw from  ( 

select C.class, S.name, C.country, C.bore  from classes as c join ships as s on c.class=s.class 

union 

select C.class, O.ship, C.country, C.bore from classes as c join outcomes as o on c.class=o.ship ) as G 

group by country 

## Задание: 34

### Укажите корабли, потопленные в сражениях в Северной Атлантике (North Atlantic). Вывод: ship.

Select ship from outcomes,battles where result= 'sunk' and battle = 'North Atlantic' group by ship  

## Задание: 35

### По Вашингтонскому международному договору от начала 1922 г. запрещалось строить линейные корабли водоизмещением более 35 тыс.тонн. Укажите корабли, нарушившие этот договор (учитывать только корабли c известным годом спуска на воду). Вывести названия кораблей.

Select name  from classes,ships where launched>=1922 and displacement>35000 and type='bb' and    

ships.class = classes.class  

## Задание: 36

### В таблице Product найти модели, которые состоят только из цифр или только из латинских букв (A-Z, без учета регистра).Вывод: номер модели, тип модели.

SELECT model, type FROM product 

WHERE model NOT LIKE '%[^0-9]%' OR model NOT LIKE '%[^a-z]%' 

## Задание: 37

### Перечислите названия головных кораблей, имеющихся в базе данных (учесть корабли в Outcomes).

Select name  from ships  where class = name   

union  

select ship as name  from classes,outcomes  where classes.class = outcomes.ship  

## Задание: 38

### Найдите классы, в которые входит только один корабль из базы данных (учесть также корабли в Outcomes).

Select class  from(select name,class from ships  

union  

select class as name,class  from classes,outcomes  where classes.class=outcomes.ship) A   

group by class  having count(A.name)=1  

## Задание: 39

### Найдите страны, имевшие когда-либо классы обычных боевых кораблей ('bb') и имевшие когда-либо классы крейсеров ('bc').

Select distinct country  from classes  where type='bb'   

intersect  

Select distinct country  from classes  where type='bc'  

## Задание: 40 > Вариант 1

### Найдите корабли, "сохранившиеся для будущих сражений"; т.е. выведенные из строя в одной битве (damaged), они участвовали в другой, произошедшей позже.

select distinct ccc.sh from ( select aaa.ship as sh, aaa.[date] as d1, bbb.[date] as d2 from ( 

select ship, [date] from outcomes as o inner join battles as b on o.battle=b.name where result = 'damaged') as aaa inner join (select ship,  

[date] from outcomes as o inner join battles as b on o.battle=b.name) as bbb on aaa.ship=bbb.ship 

where bbb.date > aaa.date) as ccc     

## Задание: 41 > Вариант 2

select distinct B.ship 

from(select * from outcomes left join battles on battle=name where result='damaged')as B 

where exists (select shipfrom outcomes left join battles on battle=name 

where ship=B.ship and B.date<date) 

## Задание: 42

### Найдите класс, имя и страну для кораблей из таблицы Ships, имеющих не менее 10 орудий.

Select classes.class , name,country from classes inner join ships on classes.class = ships.class  

where numguns >= 10  

## Задание: 43 > Вариант 1

### Для ПК с максимальным кодом из таблицы PC вывести все его характеристики (кроме кода) в два столбца:- название характеристики (имя соответствующего столбца в таблице PC);- значение характеристики

select 'speed' as m, CAST(speed as char) as a from pc where code >= all(select code from pc)  

union  

select 'model' as m, CAST(model as char) as a from pc where code >= all(select code from pc)  

union  

select 'ram' as m, CAST(ram as char) as a from pc where code >= all(select code from pc)  

union  

select 'hd' as m, CAST(hd as char) as a from pc where code >= all(select code from pc)  

union  

select 'cd' as m, CAST(cd as char) as a from pc where code >= all(select code from pc)  

union  

select 'price' as m, CAST(price as char) as a from pc where code >= all(select code from pc)   

## Задание: 43 > Вариант 2

select characteristics, value 

from (select  

cast(model as varchar(max)) as model, 

cast(speed as varchar(max)) as speed, 

cast(ram as varchar(max)) as ram, 

cast(hd as varchar(max)) as hd, 

cast(cd as varchar(max)) as cd, 

cast(price as varchar(max)) as price 

from pc where code in (select max(code) from pc)) as A 

unpivot(value for characteristics in (model, speed, ram, hd, cd, price)) as unpvt 

## Задание: 44

### Найдите названия кораблей, потопленных в сражениях, и название сражения, в котором они были потоплены.

Select ship,battle from outcomes where result ='sunk'   

## Задание: 45

### Укажите сражения, которые произошли в годы, не совпадающие ни с одним из годов спуска кораблей на воду.

select name from battles where DATEPART(yy, date) not in (select DATEPART(yy, date)  

from battles join ships on DATEPART(yy, date)=launched) 

## Задание: 46

### Найдите названия всех кораблей в базе данных, начинающихся с буквы R.

Select name from ships where name like 'R%'   

union   

Select name from battles where name like 'R%'   

union   

Select ship from outcomes where ship like 'R%'  

## Задание: 47

### Найдите названия всех кораблей в базе данных, состоящие из трех и более слов (например, King George V). Считать, что слова в названиях разделяются единичными пробелами, и нет концевых пробелов.

Select name from ships where name like '% % %'  

union   

Select ship from outcomes where ship like '% % %'   

## Задание: 48

### Укажите названия, водоизмещение и число орудий кораблей, участвовавших в сражении при Гвадалканале (Guadalcanal).

select name as n, displacement as d, numguns as ng from ships inner join classes on ships.class=classes.class where name in (select ship from outcomes where battle = 'Guadalcanal')   

union 

select ship as n, displacement as d, numguns as ng from outcomes inner join classes on outcomes.ship=classes.class where battle = 'Guadalcanal' and ship not in (select name from ships)   

union  

select ship as n, null as d, null as ng from outcomes where battle = 'Guadalcanal' and ship not in (select name from ships) and ship not in  (select class from classes)    

## Задание: 49

### Пронумеровать строки из таблицы Product в следующем порядке: имя производителя в порядке убывания числа производимых им моделей (при одинаковом числе моделей имя производителя в алфавитном порядке по возрастанию), номер модели (по возрастанию).Вывод: номер в соответствии с заданным порядком, имя производителя (maker), модель (model) 

select ROW_NUMBER() OVER(ORDER BY co desc, m, model) no, m, model  

from ( Select one.maker as m, model, co   

from product as one join (Select maker, count(model) as co from product group by maker) as two on one.maker=two.maker ) as ddd    

## Задание: 50

### Найдите классы кораблей, в которых хотя бы один корабль был потоплен в сражении.

Select class as n from ships where name in(select ship from outcomes where result='sunk')   

union  

Select ship as n from outcomes  

where ship not in(Select name from ships) and ship in(Select class from classes) and result='sunk'   

## Задание: 51

### Найдите названия кораблей с орудиями калибра 16 дюймов (учесть корабли из таблицы Outcomes).

select name from ships where class in( Select class from classes where bore=16)   

union  

select ship from outcomes where ship in( Select class from classes where bore=16)    

## Задание: 52

### Найдите сражения, в которых участвовали корабли класса Kongo из таблицы Ships.

SELECT distinct battle FROM outcomes inner JOIN Ships ON ships.name = outcomes.ship

WHERE ships.class = 'Kongo'

## Задание: 53

### Найдите названия кораблей, имеющих наибольшее число орудий среди всех имеющихся кораблей такого же водоизмещения (учесть корабли из таблицы Outcomes).

select NAME from(select name as NAME, displacement, numguns  

from ships inner join classes on ships.class = classes.class 

union 

select ship as NAME, displacement, numguns from outcomes inner join classes on outcomes.ship= classes.class) as d1 inner join (select displacement, max(numGuns) as numguns from ( select displacement, numguns from ships inner join classes on ships.class = classes.class  

union 

select displacement, numguns  from outcomes inner join classes on outcomes.ship= classes.class) as f 

group by displacement) as d2 on d1.displacement=d2.displacement and d1.numguns =d2.numguns 

## Задание: 54

### Определить названия всех кораблей из таблицы Ships, которые могут быть линейным японским кораблем, имеющим число главных орудий не менее девяти, калибр орудий менее 19 дюймов и водоизмещение не более 65 тыс.тонн

Select distinct name from ships  inner join classes cl on ships.class=cl.class 

where (numGuns>=9 or numguns is NULL) and (bore<19 or bore is NULL) and (displacement<=65000 or displacement is NULL) and type='bb' and country='japan' 

## Задание: 55

### Определите среднее число орудий для классов линейных кораблей.Получить результат с точностью до 2-х десятичных знаков.

select cast(avg(numguns*1.0) as numeric(4,2)) as Avg_numGuns  from classes where type='bb' 

## Задание: 56

### С точностью до 2-х десятичных знаков определите среднее число орудий всех линейных кораблей (учесть корабли из таблицы Outcomes).

SELECT CAST(AVG(numguns*1.0) AS NUMERIC (4,2)) as AVG_nmg 

FROM (SELECT ship, type, numguns   FROM Outcomes LEFT JOIN Classes ON ship = class  

UNION  

SELECT name, type, numguns FROM Ships as S INNER JOIN  Classes as C ON c.class = s.class ) AS T 

WHERE type = 'bb' 

## Задание: 57

### Для каждого класса определите год, когда был спущен на воду первый корабль этого класса. Если год спуска на воду головного корабля неизвестен, определите минимальный год спуска на воду кораблей этого класса. Вывести: класс, год.

select C.class, min(launched) from ships as S right join classes as C on s.class=c.class where s.launched is not null group by C.class 

## Задание: 58

### Для каждого класса определите число кораблей этого класса, потопленных в сражении. Вывести: класс и число потопленных кораблей.

select classes.class, count(T.ship) from classes left join(select ship, class from outcomes left join ships on ship=name where result='sunk'union select ship, class from outcomes left join classes on ship=class where result='sunk') as T on classes.class=T.classgroup by classes.class 

## Задание: 59

### Для классов, имеющих потери в виде потопленных кораблей и не менее 3 кораблей в базе данных, вывести имя класса и число потопленных кораблей.

select class as cls, count(class) as sunked from( 

select C.class, O.ship from classes as C join outcomes as O on C.class=O.ship where O.result='sunk' 

union 

select S.class, O.ship from outcomes as O join ships as S on S.name=O.ship where O.result='sunk') as T 

where class in ( select distinct X.class from  (select C.class, O.ship from classes as C join outcomes as O on C.class=O.ship 

union 

select C.class, S.name from classes as C join ships as S on C.class=S.class) as X group by X.class 

having count(X.class)>=3 )  group by class 

## Задание: 60

### Для каждого типа продукции и каждого производителя из таблицы Product c точностью до двух десятичных знаков найти процентное отношение числа моделей данного типа данного производителя к общему числу моделей этого производителя. Вывод: maker, type, процентное отношение числа моделей данного типа к общему числу моделей производителя

select main_maker ,main_type ,CONVERT(NUMERIC(6,2),((sub_num*100.00)/(total_num*100.00)*100.00))  

from (select count(p5.model) total_num ,p5.maker main_maker 

 from product p5 group by p5.maker) p6 JOIN (select p3.maker sub_maker ,p3.type main_type ,count(p4.model) sub_num 

 from (select p1.maker maker, p2.type type from product p1 cross join product p2 group by p1.maker, p2.type) p3 left join product p4 on p3.maker = p4.maker and p3.type = p4.type group by  p3.maker,p3.type) p7 ON p7.sub_maker = p6.main_maker 

## Задание: 61 > Вариант 1

### Посчитать остаток денежных средств на каждом пункте приема для базы данных с отчетностью не чаще одного раза в день. Вывод: пункт, остаток.

select a.point, case when o is null then i else i-o end remain FROM  (select point, sum(inc) as i 

from Income_o group by point) as A left join (select point, sum(out) as o from Outcome_o group by point) as B on A.point=B.point 

## Задание: 61 > Вариант 2

select A.point, (COALESCE (si, 0) - COALESCE (so, 0) ) from (select point, sum(inc) as si 

from income_o as i group by point) as A full join (select point, sum(out) as so from outcome_o as o 

group by point) as B on A.point=B.point 

## Задание: 62

### Посчитать остаток денежных средств на начало дня 15/04/01 на каждом пункте приема для базы данных с отчетностью не чаще одного раза в день. Вывод: пункт, остаток. Замечание. Не учитывать пункты, информации о которых нет до указанной даты.

select a.point,  case when o is null  then i else i-o end remain FROM (select point, sum(inc) as i 

from Income_o where '20010415' > date group by point) as A left join (select point, sum(out) as o 

from Outcome_o  where '20010415' > date group by point) as B on A.point=B.point  

## Задание: 63

### Посчитать остаток денежных средств на всех пунктах приема для базы данных с отчетностью не чаще одного раза в день.

select (select sum(inc) from income_o) - (select sum(out) from outcome_o) as remain  

## Задание: 64

### Посчитать остаток денежных средств на всех пунктах приема на начало дня 15/04/01 для базы данных с отчетностью не чаще одного раза в день.

select  (select sum(inc) from income_o where '20010415' > date)   

-  

(select sum(out) from outcome_o where '20010415' > date)  as remain 

## Задание: 65

### Определить имена разных пассажиров, когда-либо летевших на одном и том же месте более одного раза.

select name from Passenger where ID_psg in(Select Left([ol],CHARINDEX ( ' ', ol)) from ( 

Select CAST(concat(ID_psg,' ', place) AS VARCHAR(30)) as ol, trip_no as o, ID_psg as psg 

from Pass_in_trip ) as lll group by ol having count(o)>1) 

## Задание: 66

### Используя таблицы Income и Outcome, для каждого пункта приема определить дни, когда был приход, но не было расхода и наоборот.Вывод: пункт, дата, тип операции (inc/out), денежная сумма за день 

Select income.point, income.date, 'inc' as operation, sum(income.inc) 

from income left join outcome on income.point=outcome.point and income.date=outcome.date 

where outcome.date is null  group by income.point, income.date 

union 

Select outcome.point, outcome.date, 'out' as operation, sum(outcome.out) 

from income right join outcome on income.point=outcome.point and income.date=outcome.date 

where income.date is null group by outcome.point, outcome.date 

## Задание: 67

### Найти количество маршрутов, которые обслуживаются наибольшим числом рейсов. Замечания.  1) A - B и B - A считать РАЗНЫМИ маршрутами. 2) Использовать только таблицу Trip

select count(qqq) as qty from ( select town_from as qqq, town_to, count(plane) as cp from Trip 

group by town_from, town_to having count(plane) >= all(select count(plane)  from Trip 

group by town_from, town_to) ) as tab 

## Задание: 68

### Найти тех производителей ПК, все модели ПК которых имеются в таблице PC.

select p.maker from product p where p.type='pc' group by p.maker having count(DISTINCT p.model) = ( select count(DISTINCT pc.model) from pc where pc.model in ( select DISTINCT pr.model from product pr where pr.maker=p.maker )) 

## Задание: 69

### Вывести классы всех кораблей России (Russia). Если в базе данных нет классов кораблей России, вывести классы для всех имеющихся в БД стран.  Вывод: страна, класс

select c.country, c.class from classes c where c.country like (case when  (select count(*) from classes c 

where c.country='Russia' group by c.country) is not null THEN ('Russia') else ('%') end) 

## Задание: 70

### Найти производителей компьютерной техники, у которых нет моделей ПК, не представленных в таблице PC.

select distinct maker from product  where maker not in ( select maker from product  where model in ( 

select model from product where type='pc' except select model from pc ) ) 

## Задание: 71

### Найти производителей, которые выпускают только принтеры или только PC. При этом искомые производители PC должны выпускать не менее 3 моделей.

select maker from ( select maker from product where type='printer'  except  

select maker from product where type='laptop' except select maker from product where type='pc' ) as T 

union 

select maker from ( select maker from product inner join pc on pc.model=product.model group by maker 

having count(maker)>=3 except select maker from product where type='laptop' except  

select maker from product where type='printer' ) as S 

## Задание: 72

### Найти производителей, у которых больше всего моделей в таблице Product, а также тех, у которых меньше всего моделей. Вывод: maker, число моделей

select maker, count(maker) from product group by maker  having count(maker) in (  

select max(D.cnt) from  ( select maker, count(maker) as cnt from product group by maker ) as D 

union 

select min(F.cnt) from ( select maker, count(maker) as cnt from product group by maker ) as F ) 

## Задание: 73

### Используя таблицу Product, определить количество производителей, выпускающих по одной модели.

select count(*)  from ( select maker from product group by maker having count(model)=1 ) as Q

## Задание: 74

### Найдите страны, корабли которых имеют наибольшее число орудий.

select distinct country from classes where numGuns=(select max(numguns) from classes)

### Задание: 75

Найти имя матери

select persname from family where fstatus = 'мать'

## Задание: 76

### Узнать имя старшего из детей

select persname from family

where fstatus ='сын'

## Задание: 77

### Определите число классов линейных кораблей.

select count(*) from classes where classes.type='bb'

## Задание: 78

### Найдите производителя, продающего ПК, но не ПК-блокноты. 

SELECT DISTINCT p.maker 

FROM Product p INNER JOIN 

 PC ON p.model = PC.model
 
WHERE p.maker NOT IN (SELECT ip.maker 

 FROM Laptop il INNER JOIN 
 
 Product ip ON il.model = ip.model
 
 );
 
## Задание: 79

### Выбрать название товаров и даты покупок за март 2006

select goods.gname,payments.pdate from goods

inner join payments on payments.good=goods.ID_G

where ((pdate>=#2005-03-01#)and(pdate<=#2005-03-30#))

## Задание: 80

### Найти траты членов семьи за 2005 год

select Family.FStatus, SUM(Price * HowMany) as S

from payments, family

where (year(payments.pdate) = 2005) and (payments.who = family.id_s)

group by Family.FStatus

## Задание: 81

### Показать максимальный, минимальный и средний возраст студентов специальности «Прикладная информатика»

## Задание: 82

### Вывести среднее количество страниц, опубликованных каждым автором (автор, среднее количество страниц)

 select distinct F ,count(idB)
 
from 

   persons, autors, books
   
where

   person = idP
   
   and book = idB
   
group by F

## Задание: 83

### Какие книги были изданы до 2010 года (включительно)? Вывести названия. 
