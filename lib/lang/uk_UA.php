<?php 
defined('YV_LiteShop') or die ('Restricted Access!');

// текстовые названия валют
define('CURRENCY_CODE_TEXT_UAH', 'грн.');
define('CURRENCY_CODE_TEXT_RUR', 'руб.');
define('CURRENCY_CODE_TEXT_USD', 'usd');
define('CURRENCY_CHANGE_CURRENCY_TO', 'Змінити валюту на');

// текстовые названия языков
define('LANG_TEXT_RU', 'Російська');
define('LANG_TEXT_UA', 'Українська');
define('LANG_CHANGE_LANG_TO', 'Змінити мову на');

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
define('PC_IN_STOCK', 'В магазине');
define('PC_OUT_OF_STOCK', 'Не доступен');
define('PC_ADD_TO_CART', 'В корзину');
define('PC_PRODUCT_EAN', 'Код товара');
define('PC_PRODUCT_ATTRIBUTES', 'Атрибуты');

// Корзина
define('EMPTY_CART', 'Кошик порожній');
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
define('CKOUT_EMPTY_CART', 'Ваша Корзина пуста');
define('CKOUT_VIEW_CHECKOUT', 'Оформить');

//404 page
define('TXT_404_MAIN_TEXT', 'Уупс, страница не найдена!');
define('TXT_404_DESCR_TEXT', 'Похоже, что ничего не найдено по этому адресу. ');
define('TXT_404_DESCR_LINK_TEXT', 'Нажмите сюда');
define('TXT_404_DESCR_TEXT2', ' , чтобы вернуться на Главную страницу.');

// статусы заказов
define('ORDER_STATE_NEW', 'Новый');


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
define('MSG_CART_PRODUCT_ADDED', 'Товар добавлен в корзину!');
define('MSG_CART_PRODUCT_REMOVED', 'Товар удален из корзины!');
define('MSG_CART_REFRESH', 'Корзина обновлена!');
define('MSG_CART_ERROR_PRODUCT_UNPUBLISHED', 'Товар не опубликован. Не могу добавить товар в корзину!');
define('MSG_CART_ERROR_PRODUCT_OUT_STOCK', 'Товар закончился. Не могу добавить товар в корзину!');


 ?>