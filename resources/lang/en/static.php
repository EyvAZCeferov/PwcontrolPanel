<?php

return [
    'titles' => [
        'normal' => 'Pay and Win control panel',
        'notifications' => 'Notifications',
        'profile' => 'Profile',
        'login' => 'Login',
        'admins' => 'Admins',
    ],
    'menu' => [
        'dashboard' => 'Dashboard',
        'media' => [
            'medias' => 'Media',
            'categories' => 'Categories',
            'calendar' => 'Calendar',
            'campaigns' => 'Campaigns',
        ],
        'pwusers' => 'Pay and Win users',
        'locations' => 'Branches',
        'customers' => 'Customers',
        'admins' => 'Admins',
        'settings' => 'Settings',
    ],
    'actions' => [
        'more' => 'More...',
        'edit' => 'Edit',
        'add' => 'Add',
        'delete' => 'Remove',
        'forcedelete' => 'Remove! Not recovering',
        'recover' => 'Recover',
        'processing' => 'The operation is performed ...',
        'buttons' => 'Buttons',
        'logout' => 'Logout',
        'modes' => [
            'lightmode' => 'Bright mod',
            'darkmode' => 'Dark mod',
            'rtlmode' => 'Rtl mod',
        ],
    ],
    'pages' => [
        'login' => [
            'welcome' => 'Welcome to!',
            'signPw' => 'Log in to your PW account!',
        ],
        'dashboard' => [
            'title' => 'Control panel',
            'logincount' => 'Number of monthly entries',
            'shoppingcount' => 'Monthly sales number',
            'campaignscount' => 'Number of monthly campaign views',
            'ordercount' => 'Monthly order number',
            'daystatistic' => [
                'dayly' => 'Daily statistics',
                'allusers' => 'General users',
                'onlineusers' => 'Online users',
            ],
            'daysellerstatic' => [
                'title' => 'Sales statistics for the day',
                'bucketorder' => 'Basket order',
                'byprogramselling' => 'Sales through the application',
                'totalselling' => 'Total sales',
            ],
            'latesttransactions' => [
                'title' => 'Last sales',
                'price' => 'Price',
                'date' => 'History',
            ],
            'topviewscampaigns' => [
                'title' => 'The most watched campaigns',
            ],
        ],
        'usercheck' => [
            'title' => ':time Time shopping by :user',
            'checkinfo' => [
                'sellid' => 'Sales voucher № :id',
                'organization' => 'Organization',
                'objectcode' => 'Object code',
                'sellabout' => 'About payment',
                'numberofproducts' => 'Number of products',
                'totalprice' => 'Total price',
                'paymentmethod' => 'Payment method',
                'online' => 'Online',
                'withcard' => 'With card',
                'carddeleted' => 'Card deleted',
                'products' => 'Products',
                'barcode' => 'Barcode',
                'qyt' => 'Quantity'
            ],
        ],
    ],
    'formFields' => [
        'labels' => [
            'email' => 'E-mail',
            'password' => 'Password',
            'remember_me' => 'Remember me',
            'changepicture' => 'Select to Change Image',
            'selectpicture' => 'Select a photo',
            'name' => 'Name',
            'select' => [
                'selectrol' => 'Choose the role',
                'selectcustomer' => 'Select a customer',
            ],
            'picture' => 'Image',
            'pictures' => 'Images',
            'topcategory' => 'Top category',
            'campaignscount' => 'Campaign number',
            'branchcount' => 'Number of branches',
            'selectpictures' => 'Select images',
            'description' => 'Description',
            'location' => 'Location'
        ],
        'inputs' => [
            'email' => 'Enter your email.',
            'password' => 'Enter the password.',
            'deleted' => 'Deleted',
            'notdeleted' => 'Not Deleted',
        ],
        'validation' => [
            'max' => 'Maximum :symbol must consist of characters',
            'select' => ':role From the field below select or edit a role.',
            'deleted' => ':base deleted list',
            'lists' => ':base lists',
            'indeletedlists' => 'Deleted from the database in this :base you can control the database lists, restore data, or delete it once.',
            'notdeletedlists' => 'In this :base you can add to control base lists.',
        ],
        'buttons' => [
            'login' => 'Enter',
            'deleteimage' => 'Delete photo!'
        ],
        'actions' => [
            'nullData' => 'The information is empty.',
        ],
    ],

];
