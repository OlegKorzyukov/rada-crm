<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $menu;

    public function __construct()
    {
        $this->setMenuTask();
    }

    private function setMenuTask()
    {
        $this->menu = [
            [
                'link' => '', 'title' => 'Херсонщина', 'children' => [
                    ['link' => 'http://khor.gov.ua/oblasnyj-byudzhet/', 'title' => 'Обласний бюджет'],
                    ['link' => '', 'title' => 'Місцеве самоврядування'],
                ]
            ],
            [
                'link' => '', 'title' => 'Склад ради', 'children' => [
                    [
                        'link' => '', 'title' => 'Президія обласної ради', 'children' =>
                        [
                            ['link' => 'http://khor.gov.ua/polozhennya-pro-prezydiyu/', 'title' => 'Положення про Президію'],
                            ['link' => 'http://khor.gov.ua/sklad-prezydiyi/', 'title' => 'Склад Президії']
                        ]
                    ],
                    [
                        'link' => '', 'title' => 'Депутатський корпус', 'children' =>
                        [
                            ['link' => 'http://khor.gov.ua/deputatskyj-korpus/', 'title' => 'Депутати'],
                            ['link' => 'http://khor.gov.ua/pomichnyky-konsultanty-deputativ-oblasnoyi-rady/', 'title' => 'Помічники-консультанти'],
                            ['link' => 'http://khor.gov.ua/peredvyborchi-programy/', 'title' => 'Передвиборчі програми'],
                            ['link' => 'http://khor.gov.ua/postijni-komisiyi-oblasnoyi-rady/', 'title' => 'Постійні комісії обласної ради'],
                            ['link' => 'http://khor.gov.ua/deputatski-fraktsiyi-grupy-ta-mizhfraktsijni-ob-yednannya/', 'title' => 'Депутатські фракції, групи
            та міжфракційні об\'єднання'],
                            ['link' => 'http://khor.gov.ua/grafik-pryjomu-gromadyan-deputatamy-oblasnoyi-rady/', 'title' => 'Графік прийому громадян
            депутатами обласної ради'],
                            ['link' => 'http://khor.gov.ua/uchast-u-roboti-sesij/', 'title' => 'Участь у роботі сесій'],
                        ]
                    ],
                    [
                        'link' => 'http://khor.gov.ua/storinka-golovy-hersonskoyi-oblasnoyi-rady/', 'title' => 'Сторінка голови'
                    ],
                    [
                        'link' => '', 'title' => 'Виконавчий апарат', 'children' =>
                        [
                            ['link' => 'http://khor.gov.ua/radnyky-golovy-hersonskoyi-oblasnoyi-rady-na-gromadskyh-zasadah/', 'title' => 'Радники голови Херсонської обласної ради
                            на громадських засадах'],
                            ['link' => 'http://khor.gov.ua/konkurs-na-zajnyattya-vakantnyh-posad-u-vykonavchomu-aparati-hersonskoyi-oblasnoyi-rady/', 'title' => 'Конкурс на зайняття вакантних посад
                            у виконавчому апараті Херсонської обласної ради'],
                            ['link' => 'http://khor.gov.ua/polozhennya-pro-vykonavchyj-aparat/', 'title' => 'Положення про виконавчий апарат'],
                            ['link' => 'http://khor.gov.ua/pravyla-vnutrishnogo-trudovogo-rozporyadku/', 'title' => 'Правила внутрішнього трудового розпорядку'],
                            ['link' => 'http://khor.gov.ua/zvity-vykonavchogo-aparatu/', 'title' => 'Звіти виконавчого апарату'],
                            ['link' => 'http://khor.gov.ua/telefonnyj-dovidnyk-vykonavchogo-aparatu/', 'title' => 'Телефонний довідник виконавчого апарату'],
                        ]
                    ],
                    [
                        'link' => 'http://khor.gov.ua/koshtorys-hersonskoyi-oblasnoyi-rady/', 'title' => 'Кошторис'
                    ],
                    [
                        'link' => 'http://khor.gov.ua/misiya-funktsiyi-povnovazhennya-ta-normatyvno-pravovi-zasady-diyalnosti/', 'title' => 'Місія, функції, повноваження
                    та нормативно-правові засади діяльності'
                    ],
                    [
                        'link' => 'http://khor.gov.ua/zapobigannya-proyavam-koruptsiyi/', 'title' => 'Запобігання проявам корупції'
                    ],
                    [
                        'link' => 'http://khor.gov.ua/ochyshhennya-vlady/', 'title' => 'Очищення влади'
                    ]
                ]
            ],
            [
                'link' => '', 'title' => 'Робота ради', 'children' => [
                    [
                        'link' => '', 'title' => 'Документи Херсонської обласної ради', 'children' =>
                        [
                            ['link' => 'http://khor.gov.ua/reglament-hersonskoyi-oblasnoyi-rady-vii-sklykannya/', 'title' => 'Регламент Херсонської обласної ради'],
                            ['link' => '', 'title' => 'Проект порядку денного сесії'],
                            ['link' => 'http://khor.gov.ua/proekty-rishen/', 'title' => 'Проекти рішень'],
                            ['link' => 'http://khor.gov.ua/rishennia-sesij-khersonskoi-oblasnoi-rady/', 'title' => 'Рішення сесій'],
                            ['link' => '', 'title' => 'Результати голосування'],
                            ['link' => 'http://khor.gov.ua/protokoly-sesij-oblasnoyi-rady/', 'title' => 'Протоколи сесій обласної ради'],
                            ['link' => 'http://khor.gov.ua/protokoly-zasidannya-prezydiyi/', 'title' => 'Протоколи засідання Президії'],
                            ['link' => 'http://khor.gov.ua/protokoly-zasidan-postijnyh-komisij-hersonskoyi-oblasnoyi-rady-vii-sklykannya-ta-vysnovky-i-rekomendatsiyi/', 'title' => 'Протоколи засідань постійних комісій'],
                            ['link' => 'http://khor.gov.ua/protokoly-zasidan-deputatskykh-hrup-robochykh-hrup-stvorenykh-za-rishenniam-sesii/', 'title' => 'Протоколи засідань депутатських груп'],
                            ['link' => '', 'title' => 'Розпорядження голови'],
                            ['link' => 'http://khor.gov.ua/regulyatorni-akty/', 'title' => 'Регуляторні акти'],
                            ['link' => 'http://khor.gov.ua/regionalni-tsilovi-programy/', 'title' => 'Регіональні цільові програми']
                        ]
                    ],
                    [
                        'link' => '', 'title' => 'Календар основних заходів Херсонської обласної ради'
                    ],
                    [
                        'link' => '', 'title' => 'Взаємодія з громадськістю', 'children' =>
                        [
                            ['link' => 'http://khor.gov.ua/pryjom-gromadyan-posadovymy-osobamy-hersonskoyi-oblasnoyi-rady/', 'title' => 'Прийом громадян посадовими особами'],
                            ['link' => 'http://khor.gov.ua/zvernennya-gromadyan/', 'title' => 'Звернення громадян'],
                            ['link' => 'http://khor.gov.ua/dostup-do-publichnoyi-informatsiyi/', 'title' => 'Доступ до публічної інформації'],
                            ['link' => 'http://khor.gov.ua/zapyt-na-uchast-u-plenarnomu-zasidanni/', 'title' => 'Запит на участь у пленарному засіданні'],
                            ['link' => 'http://khor.gov.ua/polozhennya-pro-platni-poslugy/', 'title' => 'Положення про платні послуги'],
                            ['link' => 'http://khor.gov.ua/povidomlennia-pro-vchynennia-koruptsijnykh-abo-pov-iazanykh-z-koruptsiieiu-pravoporushen-pratsivnykamy-vykonavchoho-aparatu-oblasnoi-rady/', 'title' => 'Повідомлення про вчинення корупційних або пов’язаних з корупцією ']
                        ]
                    ],
                    [
                        'link' => 'http://khor.gov.ua/zakupivli-tovariv-robit-ta-poslug-za-derzhavni-koshty/', 'title' => 'Закупівлі товарів, робіт та послуг за державні кошти'
                    ],
                    [
                        'link' => '', 'title' => 'Депутатська діяльність', 'children' =>
                        [
                            ['link' => 'http://khor.gov.ua/zvity-deputativ/', 'title' => 'Звіти депутатів'],
                            ['link' => 'http://khor.gov.ua/deputatski-zapyty/', 'title' => 'Депутатські запити'],
                            ['link' => 'http://khor.gov.ua/deputatski-initsiatyvy/', 'title' => 'Депутатські ініціативи'],
                        ]
                    ],
                    [
                        'link' => '', 'title' => 'Обласні конкурси', 'children' =>
                        [
                            ['link' => 'http://khor.gov.ua/oblasnyj-konkurs-proektiv-rozvytku/', 'title' => 'Обласний конкурс проектів розвитку'],
                            ['link' => 'http://khor.gov.ua/oblasnyj-konkurs-proektiv-gromadskyh-organizatsij/', 'title' => 'Обласний конкурс проектів громадських організацій'],
                            ['link' => 'http://khor.gov.ua/oblasnyj-konkurs-zhurnalistskyh-robit/', 'title' => 'Обласний конкурс журналістських робіт'],
                            ['link' => 'http://khor.gov.ua/oblasnyj-konkurs-krashcha-knyha-khersonshchyny/', 'title' => 'Обласний конкурс Краща книга Херсонщини'],
                        ]
                    ],
                    [
                        'link' => 'http://khor.gov.ua/poriadok-vykorystannia-koshtiv-peredbachenykh-v-oblasnomu-biudzheti-dlia-nadannia-terminovoi-odnorazovoi-materialnoi-dopomohy-hromadianam-iaki-opynylysia-v-skladnykh-zhyttievykh-obstavynakh-za-zvernen/', 'title' => 'Порядок для надання термінової одноразової матеріальної допомоги'
                    ],
                    [
                        'link' => 'http://khor.gov.ua/vidkryti-dani/', 'title' => 'Відкриті дані'
                    ],
                ]
            ],
            [
                'link' => '', 'title' => 'Комунальна власність', 'children' => [
                    ['link' => 'http://khor.gov.ua/komunalni-ustanovy-ta-pidpryyemstva/', 'title' => 'Комунальні установи та підприємства'],
                    ['link' => 'http://khor.gov.ua/finansova-zvitnist-sub-yektiv-gospodaryuvannya-komunalnoyi-vlasnosti/', 'title' => 'Фінансова звітність суб’єктів господарювання'],
                    ['link' => 'http://khor.gov.ua/orenda-auktsion/', 'title' => 'Оренда'],
                    ['link' => 'http://khor.gov.ua/pryvatyzatsiya/', 'title' => 'Приватизація'],
                    ['link' => 'http://khor.gov.ua/category/informatsiia-upravlinnia-rozvytku-ob-iektiv-spilnoi-vlasnosti-terytorialnykh-hromad-oblasti-vykonavchoho-aparatu/', 'title' => 'Інформація управління розвитку об’єктів спільної власності'],
                    ['link' => 'http://khor.gov.ua/grafik-provedennya-otsinky-diyalnosti-kerivnykiv-pidpryyemstv-ustanov-ta-organizatsij/', 'title' => 'Оцінка діяльності'],
                    ['link' => 'http://khor.gov.ua/ogoloshennya-konkursu-na-posady-kerivnykiv-komunalnyh-pidpryyemstv-ustanov-ta-zakladiv/', 'title' => 'Конкурс на посади керівників'],
                    ['link' => 'http://khor.gov.ua/informatsiya-shhodo-stanu-organizatsiyi-harchuvannya-u-zakladah-shho-ye-ob-yektamy-spilnoyi-vlasnosti-terytorialnyh-gromad/', 'title' => 'Інформація щодо стану організації харчування у закладах'],
                ]
            ],
        ];
    }

    public function getMenuTask()
    {
        return $this->menu;
    }

    public function getAjaxMenu(Request $request)
    {
        if ($request->get('req') === 'getMenuInfo') {
            return response()->json($this->getMenuTask(), 200);
        }
    }
}
