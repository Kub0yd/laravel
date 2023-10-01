## AdminService
 - sendOfferInfo($request)  
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

## DispatchService

## OfferService

## SubService

## UserService
