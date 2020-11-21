<?php

return [
    'titles' => [
        'normal' => 'Панель управления Pay and Win',
        'notifications' => 'Уведомления',
        'profile' => 'Профиль',
        'login' => 'Войти',
        'admins' => 'Админы',
    ],
    'menu' => [
        'dashboard' => 'Щиток приборов',
        'media' => [
            'medias' => 'звонкий согласный',
            'categories' => 'Категории',
            'calendar' => 'Календарь',
            'campaigns' => 'Сосна',
        ],
        'pwusers' => 'Пользователи Pay and Win',
        'locations' => 'ветви',
        'customers' => 'Клиенты',
        'admins' => 'Админы',
        'settings' => 'Настройки',
    ],
    'actions' => [
        'more' => 'Больше...',
        'edit' => 'редактировать',
        'add' => 'Добавить',
        'delete' => 'удалять',
        'forcedelete' => 'Удалять! Не восстанавливается',
        'recover' => 'Восстановить',
        'processing' => 'Операция проводится ...',
        'buttons' => 'Кнопки',
        'logout' => 'Выйти',
        'modes' => [
            'lightmode' => 'Яркий мод',
            'darkmode' => 'Темный мод',
            'rtlmode' => 'Rtl мод',
        ],
    ],
    'pages' => [
        'login' => [
            'welcome' => 'Добро пожаловать в!',
            'signPw' => 'Войдите в свою учетную запись PW!',
        ],
        'dashboard' => [
            'title' => 'Панель управления',
            'logincount' => 'Количество ежемесячных записей',
            'shoppingcount' => 'Ежемесячный номер продаж',
            'campaignscount' => 'Количество просмотров кампании за месяц',
            'ordercount' => 'Номер ежемесячного заказа',
            'daystatistic' => [
                'dayly' => 'Ежедневная статистика',
                'allusers' => 'Обычные пользователи',
                'onlineusers' => 'Интернет-пользователи',
            ],
            'daysellerstatic' => [
                'title' => 'Статистика продаж за день',
                'bucketorder' => 'Заказ корзины',
                'byprogramselling' => 'Продажи через приложение',
                'totalselling' => 'Тотальная распродажа',
            ],
            'latesttransactions' => [
                'title' => 'Последние продажи',
                'price' => 'Цена',
                'date' => 'История',
            ],
            'topviewscampaigns' => [
                'title' => 'Самые просматриваемые кампании',
            ],
        ],
        'usercheck' => [
            'title' => ':time Время покупок :user',
            'checkinfo' => [
                'sellid' => 'Ваучер на продажу № :id',
                'organization' => 'Организация',
                'objectcode' => 'Код объекта',
                'sellabout' => 'Об оплате',
                'numberofproducts' => 'Количество продуктов',
                'totalprice' => 'Итоговая цена',
                'paymentmethod' => 'Способ оплаты',
                'online' => 'В сети',
                'withcard' => 'С картой',
                'carddeleted' => 'Карта удалена',
                'products' => 'Товары',
                'barcode' => 'Штрих-код',
                'qyt' => 'Количество',
            ],
        ],
    ],
    'formFields' => [
        'labels' => [
            'email' => 'Эл. почта',
            'password' => 'пароль',
            'remember_me' => 'Запомните меня',
            'changepicture' => 'Выберите, чтобы изменить изображение',
            'selectpicture' => 'Выбрать фото',
            'name' => 'название',
            'select' => [
                'selectrol' => 'Выберите роль',
                'selectcustomer' => 'Выберите клиента',
            ],
            'picture' => 'Образ',
            'pictures' => 'Изображений',
            'topcategory' => 'Высшая категория',
            'campaignscount' => 'Номер кампании',
            'branchcount' => 'Количество филиалов',
            'selectpictures' => 'Выбрать изображения',
            'description' => 'Описание',
            'location' => 'Место расположения'
        ],
        'inputs' => [
            'email' => 'Введите адрес электронной почты.',
            'password' => 'Введите пароль.',
            'deleted' => 'Удалено',
            'notdeleted' => 'Не удалено',
        ],
        'validation' => [
            'max' => 'Максимум :symbol должен состоять из символов',
            'select' => ':role В поле ниже выберите или отредактируйте роль.',
            'deleted' => ':base удаленный список',
            'lists' => ':base списки',
            'indeletedlists' => 'Удаляется из базы данных в этом :base вы можете управлять списками базы данных, восстанавливать данные или удалять их один раз.',
            'notdeletedlists' => 'В этом :base вы можете добавить в контрольные списки базы.',
        ],
        'buttons' => [
            'login' => 'Войти',
            'deleteimage' => 'Удалить фото!'
        ],
        'actions' => [
            'nullData' => 'Информация пуста.',
        ],
    ],
];
