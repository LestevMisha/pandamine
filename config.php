<?php
$cfg = array(
    'message' => '<strong>Внимание!</strong> Действуют <strong>скидки</strong> на весь донат!',
    'servers' => array(
        'Выживание' => array(
            'srv_id' => 1,
            'servers' => array(
                array(
                    'rcon_ip' => '88.99.2.243',
                    'rcon_port' => 33333,
                    'rcon_pass' => 'adyh1d89asjkrSAs',
                ),
            ),
            'db' => array(
                'mysql_host' => '178.32.198.155',
                'mysql_db' => 'surv',
                'mysql_user' => 'surv',
                'mysql_pass' => '0XqFejdtGVdHLZjJ',
            ),
            'privileges' => array(
                'Привилегии' => array(
                    'Лайт' => array(
                        'id' => 1,
                        'price' => 15,
                        'cmd' => 'lp user <user> parent add lite',
                        'role' => 'lite',
                    ),
                    'Премиум' => array(
                        'id' => 2,
                        'price' => 25,
                        'cmd' => 'lp user <user> parent add premium',
                        'role' => 'premium',
                    ),
                    'Креатив' => array(
                        'id' => 3,
                        'price' => 50,
                        'cmd' => 'lp user <user> parent add creative',
                        'role' => 'creative',
                    ),
                    'Модератор' => array(
                        'id' => 4,
                        'price' => 75,
                        'cmd' => 'lp user <user> parent add moder',
                        'role' => 'moder',
                    ),
                    'Лорд' => array(
                        'id' => 5,
                        'price' => 109,
                        'cmd' => 'lp user <user> parent add lord',
                        'role' => 'lord',
                    ),
                    'Админ' => array(
                        'id' => 6,
                        'price' => 158,
                        'cmd' => 'lp user <user> parent add admin',
                        'role' => 'admin',
                    ),
                    'S-Админ' => array(
                        'id' => 7,
                        'price' => 219,
                        'cmd' => 'lp user <user> parent add s-admin',
                        'role' => 's-admin',
                    ),
                    'Делюкс' => array(
                        'id' => 8,
                        'price' => 325,
                        'cmd' => 'lp user <user> parent add delux',
                        'role' => 'delux',
                    ),
                    'Ультра' => array(
                        'id' => 9,
                        'price' => 490,
                        'cmd' => 'lp user <user> parent add ultra',
                        'role' => 'ultra',
                    ),
                    'Директор' => array(
                        'id' => 10,
                        'price' => 745,
                        'cmd' => 'lp user <user> parent add direktor',
                        'role' => 'direktor',
                    )
                ),
                'Элитные привилегии' => array(
                    'Король' => array(
                        'id' => 11,
                        'price' => 1479,
                        'cmd' => 'lp user <user> parent add korol',
                        'role' => 'korol',
                    ),
                    'PANDA' => array(
                        'id' => 12,
                        'price' => 2350,
                        'cmd' => 'lp user <user> parent add panda',
                        'role' => 'panda',
                    ),
                    'ЭЛИТА' => array(
                        'id' => 13,
                        'price' => 4475,
                        'cmd' => 'lp user <user> parent add elite',
                        'role' => 'elite',
                    )
                ),
                'Авторский!' => array(
                    'L U X O R + консоль' => array(
                        'id' => 14,
                        'price' => 13440,
                        'cmd' => 'lp user <user> parent add luxor',
                        'role' => 'luxor',
                        'role' => 'elite',
                    )
                ),
            )
        ),
        'Кейсы' => array(
            'srv_id' => 2,
            'servers' => array(
                array(
                    'rcon_ip' => '88.99.2.243',
                    'rcon_port' => 33333,
                    'rcon_pass' => 'adyh1d89asjkrSAs',
                ),
            ),
            'privileges' => array(
                'Донат-кейсы' => array(
                    '1 кейс' => array(
                        'id' => 22,
                        'price' => 42,
                        'cmd' => 'cases give <user> donate 1',
                        'no_extra' => true,
                        'role' => '1',
                    ),
                    '3 кейса' => array(
                        'id' => 23,
                        'price' => 105,
                        'cmd' => 'cases give <user> donate 3',
                        'no_extra' => true,
                        'role' => '3',
                    ),
                    '5 кейсов' => array(
                        'id' => 24,
                        'price' => 170,
                        'cmd' => 'cases give <user> donate 5',
                        'no_extra' => true,
                        'role' => '5',
                    ),
                    '10 кейсов' => array(
                        'id' => 25,
                        'price' => 385,
                        'cmd' => 'cases give <user> donate 10',
                        'no_extra' => true,
                        'role' => '10',
                    ),
                    '20 кейсов' => array(
                        'id' => 26,
                        'price' => 729,
                        'cmd' => 'cases give <user> donate 20',
                        'no_extra' => true,
                        'role' => '20',
                    ),
                    '30 кейсов' => array(
                        'id' => 27,
                        'price' => 999,
                        'cmd' => 'cases give <user> donate 30',
                        'no_extra' => true,
                        'role' => '30',
                    )
                ),
                'Кейсы с лычками (титулы)' => array(
                    'Животные - 3 шт.' => array(
                        'id' => 28,
                        'price' => 79,
                        'cmd' => 'cases give <user> Animals 3',
                        'role' => 'Animals 3',
                    ),
                    'Статусы - 3 шт.' => array(
                        'id' => 29,
                        'price' => 79,
                        'cmd' => 'cases give <user> Status 3',
                        'role' => 'Status 3',
                    ),
                    'Прочие - 3 шт.' => array(
                        'id' => 30,
                        'price' => 79,
                        'cmd' => 'cases give <user> Others 3',
                        'role' => 'Others 3',
                    ),
                    'Символьные - 3 шт.' => array(
                        'id' => 31,
                        'price' => 199,
                        'cmd' => 'cases give <user> Symbols 3',
                        'role' => 'Symbols 3',
                    )
                ),
                'Ограниченная продажа!' => array(
                    'Все лычки /tabgirl' => array(
                        'id' => 15,
                        'price' => 1890,
                        'cmd' => 'lp user <user> add tab.girl.*',
                        'no_extra' => true,
                        'role' => 'tab.girl.*',
                    )
                ),
            )
        ),
        'SkyPvP' => array(
            'srv_id' => 3,
            'servers' => array(
                array(
                    'rcon_ip' => '88.99.2.243',
                    'rcon_port' => 22226,
                    'rcon_pass' => 'YDyzzB9BA9JXUrovGONxYIkbTdOuCMjEbF9Qr60c6ofubA0auH',
                ),
            ),
            'privileges' => array(
                'Привилегии' => array(
                    'Вип' => array(
                        'id' => 1023,
                        'price' => 90,
                        'cmd' => 'lp user <user> parent add vip',
                        'role' => 'vip',
                    ),
                    'Лайт' => array(
                        'id' => 104,
                        'price' => 190,
                        'cmd' => 'lp user <user> parent add lite',
                        'role' => 'lite',
                    ),
                    'Делюкс' => array(
                        'id' => 101,
                        'price' => 290,
                        'cmd' => 'lp user <user> parent add deluxe',
                        // 'cmd' => 'lp user <user> parent add deluxe;rg addmember -w world donate <user>',
                        'role' => 'deluxe',
                    ),
                    '[✔]' => array(
                        'id' => 102,
                        'price' => 390,
                        'cmd' => 'lp user <user> parent addtemp error 30d',
                        // 'cmd' => 'lp user <user> parent addtemp error 30d;rg addmember -w world donate <user>',
                        'role' => '30d',
                    )
                ),
                'Игровая валюта (во время покупки быть онлайн)' => array(
                    '25 000$' => array(
                        'id' => 40,
                        'price' => 25,
                        'cmd' => 'eco give <user> 25000',
                        'no_extra' => true,
                        'role' => '25000',
                    ),
                    '50 000$' => array(
                        'id' => 69,
                        'price' => 50,
                        'cmd' => 'eco give <user> 50000',
                        'no_extra' => true,
                        'role' => '50000',
                    ),
                    '100 000$' => array(
                        'id' => 42,
                        'price' => 100,
                        'cmd' => 'eco give <user> 100000',
                        'no_extra' => true,
                        'role' => '100000',
                    ),
                    '300 000$' => array(
                        'id' => 44,
                        'price' => 270,
                        'cmd' => 'eco give <user> 300000',
                        'no_extra' => true,
                        'role' => '300000',
                    ),
                    '500 000$' => array(
                        'id' => 45,
                        'price' => 425,
                        'cmd' => 'eco give <user> 500000',
                        'no_extra' => true,
                        'role' => '500000',
                    ),
                    '1 000 000$' => array(
                        'id' => 46,
                        'price' => 740,
                        'cmd' => 'eco give <user> 1000000',
                        'no_extra' => true,
                        'role' => '1000000',
                    ),
                    '2 000 000$' => array(
                        'id' => 47,
                        'price' => 1275,
                        'cmd' => 'eco give <user> 2000000',
                        'no_extra' => true,
                        'role' => '2000000',
                    ),
                    '5 000 000$' => array(
                        'id' => 48,
                        'price' => 3457,
                        'cmd' => 'eco give <user> 5000000',
                        'no_extra' => true,
                        'role' => '5000000',
                    )
                ),
            )
        ),
        'Другое' => array(
            'srv_id' => 4,
            'servers' => array(
                array(
                    'rcon_ip' => '88.99.2.243',
                    'rcon_port' => 25458,
                    'rcon_pass' => 'gXHbXGSKQ4ew',
                ),
            ),
            'privileges' => array(
                'Разбан (не лобби бан)' => array(
                    'Снять бан' => array(
                        'id' => 30,
                        'price' => 100,
                        'cmd' => 'unban <user>',
                        'no_extra' => true,
                        'role' => 'unban',
                    )
                ),

                'Арендовать Баннер' => array(
                    'Ваш баннер на spawne (1 день)' => array(
                        'id' => 32,
                        'price' => 70,
                        'days' => 1,
                        'cmd' => 'donatebanner set-image <link> 24 <user>',
                        'no_extra' => true,
                        'role' => 'banner-24',
                    ),
                    'Ваш баннер на spawne (7 дней)' => array(
                        'id' => 33,
                        'price' => 420,
                        'days' => 7,
                        'cmd' => 'donatebanner set-image <link> 168 <user>',
                        'no_extra' => true,
                        'role' => 'banner-168',
                    ),
                    'Ваш баннер на spawne (30 дней)' => array(
                        'id' => 34,
                        'price' => 1500,
                        'days' => 30,
                        'cmd' => 'donatebanner set-image <link> 720 <user>',
                        'no_extra' => true,
                        'role' => 'banner-720',
                    )
                ),

                'Подписки' => array(
                    'Подписка PandaPlus' => array(
                        'id' => 35,
                        'price' => 299,
                        'additional_price_text' => "рублей/мес",
                        'cmd' => 'lp user <user> parent addtemp pandaplus 30d',
                        'no_extra' => true,
                        'role' => 'pandaplus',
                    ),
                ),
            )
        ),
    ),
    /* Promo-code */
    'promocode' => 'LIPANDA|PANDAM|PANDA770',
    'promocode_percents' => '5|7|10',
    /* MySQL */
    'mysql_host' => 'server166.hosting.reg.ru',
    'mysql_db' => 'u0718842_panda',
    'mysql_user' => 'u0718842_123',
    'mysql_pass' => 'tR6vK3pW1fpT7zM3',
    /* UnitPay */
    'SECRET_KEY' => '6acdf6e881ce50364b8b1c8456ebcf7c',
    'PUBLIC_KEY' => '151851-275b7',
    'UPLOAD_WEBSITE_URL' => 'https://pandamine.ru/uploads/',


    'console' => array( //CONSOLE SETTINGS
        'auth_url' => 'pandamine.ru/console', //AUTH URL (DEFAULT: URL_SITE)
        'vk_id' => '137408919', //VK APP ID
        'vk_secret' => 'CwzXeoq0eqzK62QFlsaQ', //VK APP SECRET
        'name' => 'PandaMine', //CONSOLE TITLE
        'title_small' => '<b>P</b>M', //CONSOLE SMALL TITLE
        'title_size' => '<b>PandaMine</b> Консоль', //CONSOLE SIZE TITLE
        'title_site' => 'PandaMine', //CONSOLE TITLE ALL PAGES
        'title_auth' => '<b>PandaMine</b> Консоль', //CONSOLE TITLE AUTH PAGE

        'server' => array( //CONSOLE RCON SERVER SETTINGS
            'ip' => '88.99.2.243', //IP
            'port' => '33333', //RCON PORT
            'password' => 'adyh1d89asjkrSAs' //RCON PASS
        ),
    ),

);
//ALTER TABLE `pay` ADD `promo` INT NULL DEFAULT NULL AFTER `respond`;
