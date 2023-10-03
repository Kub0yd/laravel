## [AdminController](./AdminController.php)
Класс для работы со страницей /admin   

[index()](./AdminController.php#L22):  
Возвращает blade adminPanel с коллекциями офферов, пользователей, транзакций и баланса для пользователя с правами администрирования.  

[store($request)](./AdminController.php#L61):
Принимает post request из admin.js с типами сообщений:  
1. getOfferInfo 
2. getUserInfo
3. updateUserRoles
4. getOfferErrors

## [OfferController](./OfferController.php)
Класс для работы со страницей /main  

[index()](./OfferController.php#L26):  
Возвращает blade main для авторизованного пользователя с коллекциями:  
$offers - список созданных пользователем офферов  
$userSubs - список активных подписок пользователя  
$allOffers - список доступных пользователю подписок (где он не создатель оффера и не подписчик)  
$balance - текущий баланс с учетом доходов по подпискам и расходам по офферам  

[store($request)](./OfferController.php#L63):
Принимает post request из main.js с типами сообщений:  
1. subscription 
2. unsubscribe
3. getUpdates

По умолчанию - создание нового оффера

[update()](./OfferController.php#L108):  
Принимает put request из main.js с типами сообщений:  
1. offerStatus

## [RedirectController](./RedirectController.php)
Класс для системы редиректоров  

[redirect($request)](./RedirectController.php#L25):  
По текущей ссылке получает подписку пользователя $sub, и оффер найденой подписки $offer.    
Если подписка не найдена - скидываем в 404.  
Если подписка или оффер не активны - записываем в таблицу bad_transactions и переводим в 404. 

Если подписка и оффер активны -  

Создаем новую запись в таблице transactions ($transaction). Передаем в нее id оффера, id подписчика, и стоимость оффера.   
 После этого передаем в частный канал подписчика данные о транзакции для обновления данных о доходе - $income, и аналогично в частный канал создателя оффера для обновления данных о расходах по офферу - $loss.  
 В админский канал передаем расход и доход  по офферу - $data.  
 Затем записываем транзакцию в лог.  
 Перенаправляем клиента на конечный адрес оффера.
 
