<?php 
defined('YV_LiteShop') or die ('Restricted Access!');


// текстовые названия валют
define('CURRENCY_CODE_TEXT_UAH', 'грн.');
define('CURRENCY_CODE_TEXT_RUR', 'руб.');
define('CURRENCY_CODE_TEXT_USD', 'usd');
define('CURRENCY_CHANGE_CURRENCY_TO', 'Сменить валюту на');

// текстовые названия языков
define('LANG_TEXT_RU', 'Русский');
define('LANG_TEXT_UA', 'Украинский');
define('LANG_CHANGE_LANG_TO', 'Сменить язык на');

// способы доставки
define('SM_NOVA_POSTA_OFFICE', 'Новая Почта. Отделение.');
define('SM_NOVA_POSTA_HOME', 'Новая Почта. К двери.');
define('SM_UKR_POSTA_OFFICE', 'УкрПочта. Отделение.');
define('SM_UKR_POSTA_HOME', 'УкрПочта. К двери.');

// способы оплаты
define('PM_PRIVAT24', 'Приват 24');
define('PM_NOVA_POSTA_NALOGKA', 'Новая Почта. Наложеный платеж.');

// Главная
define('TXT_HP_HOMEPAGE', 'Главная');

// Карточка товара
define('PC_QUANTITY', 'Количество');
define('PC_AVAILABILITY', 'Доступность');
define('PC_IN_STOCK', 'В наличии');
define('PC_OUT_OF_STOCK', 'Нет в наличии');
define('PC_SOON_STOCK', 'Ожидается поступление');
define('PC_ADD_TO_CART', 'В корзину');
define('PC_PRODUCT_EAN', 'Код товара');
define('PC_PRODUCT_ATTRIBUTES', 'Атрибуты');
define('PC_PRODUCT_VIDEOS', 'Видео');
define('PC_QTY_PRICE_LABEL', 'Цена в зависимости от кол-ва');
define('PC_QTY_UNIT', 'шт.');
define('PC_TAB_DESCRIPTION', 'Обзор');
define('PC_TAB_SPECIFICATIONS', 'Характеристики');
define('PC_TAB_PAYMENT', 'Способы оплаты');
define('PC_TAB_SHIPPING', 'Способы доставки');
define('PC_TAB_FILES', 'Файлы');
define('PC_RELATED_PRODUCTS', 'Сопутствующие товары');

// Корзина
define('EMPTY_CART', 'Корзина пуста');
define('CART_IMAGE', 'Изображение');
define('CART_PRODUCT', 'Товар');
define('CART_PRICE', 'Цена за ед.');
define('CART_QUANTITY', 'Количество');
define('CART_QTY', 'Кол-во');
define('CART_QTY_FROM', 'от');
define('CART_QTY_TO', 'до');
define('CART_QTY_UNIT', 'шт.');
define('CART_SUBTOTAL', 'Сумма');
define('CART_SUBTOTAL_PAY', 'Итого');
define('CART_TOTAL', 'Итого');
define('CART_REMOVE', 'Удалить');
define('CART_UPDATE', 'Обновить');
define('CART_VIEW_CART', 'В корзину');

// Оформление заказа
define('CKOUT_CANNOT_PROCESS_CHECKOUT', 'Не можем оформить Вашу покупку');
define('CKOUT_CUSTOMER_DETAILS_DESCR', 'Пожалуйста, заполните форму ниже корректными данными, которые мы будем использовать для доставки вашей покупки. ');
define('CKOUT_PAYMENT_METHOD_DESCR', 'Пожалуйста, выберите удобный для Вас способ оплаты.');
define('CKOUT_SHIPPING_METHOD_DESCR', 'Пожалуйста, выберите удобный для Вас способ доставки.');
define('ORDER_TOTAL_SHIPPING', 'Стоимость доставки');
define('ORDER_TOTAL_PAYMENT', 'Стоимость оплаты');
define('ORDER_TOTAL', 'Итого к оплате');
define('CKOUT_EMPTY_CART', 'Ваша Корзина пуста');
define('CKOUT_YOUR_ORDER', 'Ваша покупка');
define('CKOUT_VIEW_CHECKOUT', 'Оформить');
define('CKOUT_BILLING_DETAILS', 'Детали покупки');
define('CKOUT_FIRST_NAME', 'Имя');
define('CKOUT_SECOND_NAME', 'Фамилия');
define('CKOUT_EMAIL', 'E-mail');
define('CKOUT_PHONE', 'Номер телефона');
define('CKOUT_SHIPPING_ADRESS', 'Адрес доставки');
define('CKOUT_SHIPPING_ADRESS_PLACEHOLDER', 'Адрес доставки (№ отд. почты)');
define('CKOUT_CITY', 'Город');
define('CKOUT_ZIPCODE', 'Почтовый индекс');
define('CKOUT_PAYMENT_METHOD', 'Способ оплаты');
define('CKOUT_SHIPPING_METHOD', 'Способ доставки');
define('CKOUT_PLACE_ORDER', 'Оформить покупку');
define('CKOUT_COMMENTS', 'Комментарии');

// Show Order page
define('SHOW_ORDER_ORDER_NUMBER', '№ заказа');
define('SHOW_ORDER_PRODUCTS', 'Товары');
define('SHOW_ORDER_BILLING', 'Получатель');
define('SHOW_ORDER_SHIPPING_METHOD', 'Способ достаки');
define('SHOW_ORDER_PAYMENT_METHOD', 'Способ оплаты');
define('SHOW_ORDER_COMMENTS', 'Комментарии');
define('SHOW_ORDER_FIRST_NAME', 'Имя');
define('SHOW_ORDER_SECOND_NAME', 'Фамилия');
define('SHOW_ORDER_EMAIL', 'e-mail');
define('SHOW_ORDER_PHONE', 'Телефон');
define('SHOW_ORDER_ADDRESS', 'Адрес доставки');
define('SHOW_ORDER_CITY', 'Город');
define('SHOW_ORDER_ZIPCODE', 'Индекс');
define('SHOW_ORDER_ORDER_STATUS_NEW_MESSAGE_1', 'Ваш заказ успешно обработан.');
define('SHOW_ORDER_ORDER_STATUS_NEW_MESSAGE_2', 'Наши менеджеры свяжутся с Вами в ближайшее время для подтверждения заказа.');

//404 page
define('TXT_404_MAIN_TEXT', 'Уупс, страница не найдена!');
define('TXT_404_DESCR_TEXT', 'Похоже, что ничего не найдено по этому адресу. ');
define('TXT_404_DESCR_LINK_TEXT', 'Нажмите сюда');
define('TXT_404_DESCR_TEXT2', ' , чтобы вернуться на Главную страницу.');




// Разное
define('TXT_CALL_US', 'Звоните нам');
define('TXT_READMORE', 'Подробнее');

define('PAGE_ERROR_404', 'Страница не найдена');
define('PAGE_PRODUCT', 'Товар');
define('PAGE_CART', 'Корзина');
define('PAGE_CHECKOUT', 'Оформить покупку');
define('PAGE_ORDER_FINISH', 'Заказ размещен');
define('PAGE_SHOW_ORDER', 'Информация о заказе');


// Сообщения
define('MSG_WRONG_DATA', 'Не верные данные! Проверьте правильность передаваемых данных.');
define('MSG_WRONG_CURRENCY', 'Неверная валюта заказа.');
define('MSG_WRONG_PAYMENT_AND_SHIPPING_METHODS', 'Неверный способ оплаты и доставки.');
define('MSG_WRONG_SHIPPING_METHOD', 'Неверный способ доставки.');
define('MSG_WRONG_PAYMENT_METHOD', 'Неверный способ оплаты.');
define('MSG_CART_PRODUCT_ADDED', 'Товар добавлен в корзину!');
define('MSG_CART_PRODUCT_REMOVED', 'Товар удален из корзины!');
define('MSG_CART_REFRESH', 'Корзина обновлена!');
define('MSG_CART_ERROR_PRODUCT_UNPUBLISHED', 'Товар не опубликован. Не могу добавить товар в корзину!');
define('MSG_CART_ERROR_PRODUCT_OUT_STOCK', 'Товар закончился. Не могу добавить товар в корзину!');
define('MSG_ORDER_RECIVED', 'Ваш заказ успешно сохранен! В скором времени с Вами свяжется менеджер для подтверждений заказа. <b><i>Благодарим за покупку!</i></b>');



 ?>