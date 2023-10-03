## [AdminService](./AdminService.php)
 - [sendOfferInfo($request)](./AdminService.php#L14)  
Описание: отправляет в канал администратора информацию по офферу  
Параметры:  
$request - содержит id оффера {offer_id}  
$offer - получаемый объект оффера по id из $request  
$offerSubsList - список подписок по офферу  
$sub - подписка из списка $offerSubList  
$user - пользователь подписки  
$userOfferIncome - доход юзера от подписики  
$offerUserInfo[] - массив для отправки в admin.js:
    - 'user_name' - имя пользователя $user
    - 'user_id' - id пользователя $user
    - 'user_income' - $userOfferIncome 
    - 'user_roles' - роли пользователя $user
    - 'user_personalURL' - персональная ссылка подписки пользователя
    - 'is_active' - состояние подписки  

 - [sendUserInfo($request)](./AdminService.php#L39) 
Описание: отправляет в канал администратора подписки и офферы определенного пользователя  
Параметры:  
$request - содержит имя пользователя {user_name}    
$user - нйденный объект пользователя  
$userSubs - подписки пользователя  
$userOffers - офферы пользователя  
$subInfo[] - массив для отправки в admin.js  
    - 'user_name' - имя пользователя $user
    - 'user_id' - id пользователя $user
    - 'user_income' - доход юзера от всех подписок
    - 'user_roles' - роли пользователя $user
    - 'user_transactions' - количество переходов пользователя
    - 'sub_data' - массив с данными для каждой подписке
        - 'offer_title' - название оффера 
        - 'offer_id' - id оффера
        - 'offer_creator' - имя создателя оффера
        - 'user_personalURL' - персональная ссылка подписчика
        - 'is_active' - состояние активности подписки
        - 'sub_income' - доход от подписки
        - 'sub_transactions' - количество переходов по подписке
    - 'offer_data' - массив с данными по каждому офферу пользователя
        - 'is_active' - состояние оффера 
        - 'offer_id' - id оффера
        - 'offer_title' - название оффера
        - 'offer_URL' - целевая ссылка оффера
        - 'offer_price' - стоимость перехода оффера
        - 'offer_subs' - количество подписок по офферу  
        - 'offer_loss' - расход по офферу

 - [updateUserRoles($request)](./AdminService.php#L92) 
Описание: отключает зарзрешения/роли пользователя и назначает нововые новые 
Параметры:  
$request - содержит id пользователя и роли {user_id, user_roles}  
$user - объект найденного пользователя  

 - [assignRole($user, $roleName)](./AdminService.php#L108)
Описание:  назначает роли и разрешения пользователя  
Параметры:  
$role - объект роли 
$user - объект пользователя  
$permissions - разрешения для роли  

 - [sendOfferErrors($request)](./AdminService.php#L117)  
Описание: отправляет в канал администратора ошибки переходов по офферу  
Параметры:  
$request - содержит id оффера {offer_id}  
$offer  - объект найденного оффера  
$subs - подписки оффера  
$badTransactions[] - массив с ошибками переходов по каждой подписке  
    - 'sub_id' - id подписки
    - 'webmaster' - имя подписанного пользователя
    - 'errors' - записи по ошибкам (id подписки, ip клиента, время) 


## [DispatchService](./DispatchService.php)
- [AdminChannelSend($data)](./DispatchService.php#L14)  
Описание: отправляет в админский канал данные  
- [UserChannelSend($userId, $data)](./DispatchService.php#L19)  
Описание: отправляет в частый канал пользователя данные  
- [OfferStatusChannelSend($data)](./DispatchService.php#L24)  
Описание: отправляет в общий канал данные  
- [createResponse($type, $data)](./DispatchService.php#L30)  
Описание: возвращает структуру для отправки на клиент  данных

## [OfferService](./OfferService.php)
- [updateOfferStatus($requestData)](./OfferService.php#L17)  
Описание: отправляет в общий канал и канал подписчика оффера состояние его активности   
Параметры:  
$requestData - содержит id оффера и его состояние {offer_id, is_active}  
$offer - объект найденного оффера  
$offerSubs - активные подписки оффера  
$offerStatus[] - массив для отправки в общий канал
    - 'offer_id' - id оффера
    - 'is_active' - состояние оффера
    - 'price' - стоимость перехода оффера
    - 'creator' - имя создателя оффера
    - 'title' - наименование оффера
    - 'URL' - целевая ссылка оффера  
 $data[] - массив для отправки в частный канал пользователя 
    - 'offer_id' - id оффера
    - 'user_link' - персональная ссылка подписчика
    - 'offer_active' - состояние оффера  
- [createOffer($request)](./OfferService.php#L53)
Описание: создает запись нового оффера  
Параметры:  
$request - содержит название, ссылку и стоимость оффера {title, url, price}
$data - массив для отправки в админский канал
    - 'offer_id' - id оффера
    - 'price' - стоимость перехода оффера
    - 'creator' - имя создателя оффера
    - 'title' - название оффера
    - 'URL' - целевая ссылка оффера
## [SubService](./SubService.php)
 - [subscribe($request)](./SubService.php#L19)
Описание: обновляет статус подписки или создает новую запись. Затем отправляет в общий канал состояние подписки, и в частный канал информацию о  подписке  
 - [unsubscribe($request)](./SubService.php#L58)
 Описание: изменяет состояние подписки и отправляет информацию в общий канал

## [UserService](./UserService.php)
- [newUserRole($user)](./UserService.php#L10)  
Описание: добавляет новому пользователю роли и разрешения  
$user - объект пользователя 
- [adminRole($user)](./UserService.php#L17)
Описание:назначает права администратора  
