<?php
use \WebGuy;

class InstallCest
{
    public function testInstall(WebGuy $I)
    {
        $I->wantTo('Test Yupe! installation process!');
        $I->amOnPage('/install/default');

        $I->wantTo('Test begin install!');
        // begin install
        //$I->seeInTitle('Юпи! Установка Юпи!');
        $I->see('Добро пожаловать!', 'h1');
        $I->see('Шаг 1 из 8 : "Приветствие!', 'span');

        // check external link
        //$I->seeLink('amyLabs','http://amylabs.ru/?from=yupe-install');
        //$I->seeLink('Форум','http://yupe.ru/talk/?from=login');
        //$I->seeLink('http://yupe.ru','http://yupe.ru?from=install');

        $I->seeLink('Начать установку >');

        // environment check
        $I->click('Начать установку >');
        $I->seeInCurrentUrl('environment');
        $I->dontSee('Дальнейшая установка невозможна, пожалуйста, исправьте ошибки!', \CommonPage::ERROR_CSS_CLASS);
        $I->see('Шаг 2 из 8 : "Проверка окружения!', 'span');
        $I->seeLink('< Назад');
        $I->seeLink('Продолжить >');

        // requirements check
        $I->click('Продолжить >');
        $I->seeInCurrentUrl('requirements');
        $I->dontSee('Дальнейшая установка невозможна, пожалуйста, исправьте ошибки!', \CommonPage::ERROR_CSS_CLASS);
        $I->see('Шаг 3 из 8 : "Проверка системных требований', 'span');
        $I->seeLink('< Назад');
        $I->seeLink('Продолжить >');

        // dbsettings check
        $I->click('Продолжить >');
        $I->seeInCurrentUrl('dbsettings');
        $I->see('Шаг 4 из 8 : "Соединение с базой данных', 'span');

        // check db settings form
        // mysql checked
        $I->selectOption('InstallForm[dbType]', '1');
        $I->seeInField('InstallForm[host]', 'localhost');
        $I->seeInField('InstallForm[port]', '3306');
        $I->seeInField('InstallForm[dbName]', '');
        $I->dontSeeCheckboxIsChecked('InstallForm[createDb]');
        $I->cantSeeInField('InstallForm[tablePrefix]', '_yupe');
        $I->seeInField('InstallForm[dbUser]', '');
        $I->seeInField('InstallForm[dbPassword]', '');
        $I->seeInField('InstallForm[socket]', '');

        $I->seeLink('< Назад');
        $I->see('Проверить подключение и продолжить >');

        $I->click('Проверить подключение и продолжить >');
        $I->see('Необходимо исправить следующие ошибки:', \CommonPage::ERROR_CSS_CLASS);
        $I->see('Необходимо заполнить поле «Название базы данных».', \CommonPage::ERROR_CSS_CLASS);
        $I->see('Необходимо заполнить поле «Пользователь».', \CommonPage::ERROR_CSS_CLASS);

        $I->fillField('InstallForm[dbName]', 'yupetest');
        $I->fillField('InstallForm[dbUser]', 'root');
        $I->fillField('InstallForm[dbPassword]', 'root');
        $I->checkOption('InstallForm[createDb]');

        $I->click('Проверить подключение и продолжить >');
        $I->dontSee('Не удалось создать БД!', \CommonPage::ERROR_CSS_CLASS);

        $I->see('Шаг 5 из 8 : "Установка модулей');
        $I->seeInCurrentUrl('modulesinstall');
        $I->see('Доступно модулей:', \CommonPage::SUCCESS_CSS_CLASS);
        $I->see('20', '.label-info');
        $I->see('7', '.label-info');

        $links = array('Рекомендованные', 'Только основные', 'Все');

        foreach ($links as $link) {
            $I->see($link, '.btn-info');
        }

        $I->seeLink('< Назад');
        $I->see('Продолжить >');

        $I->click('Все');

        $I->click('Продолжить >');
        $I->see('Будет установлено', 'h4');
        $I->see('Отмена');
        $I->click('Продолжить >', '.modal-footer');


        $I->seeInCurrentUrl('modulesinstall');
        $I->see('Шаг 5 из 8 : "Установка модулей', 'span');
        $I->see('Идет установка модулей...', 'h1');
        $I->see('Журнал установки', 'h3');


        $I->wait(70000);
        $I->see('20 / 20');
        $I->see('Установка завершена', 'h4');
        $I->see('Поздравляем, установка выбранных вами модулей завершена.');
        $I->see('Смотреть журнал');

        //check admin create
        $I->click('Продолжить >', '.modal-footer');
        $I->seeInCurrentUrl('createuser');
        $I->see('Шаг 6 из 8 : "Создание учетной записи администратора', 'span');
        $I->seeInField('InstallForm[userName]', '');
        $I->seeInField('InstallForm[userEmail]', '');
        $I->seeInField('InstallForm[userPassword]', '');
        $I->seeInField('InstallForm[cPassword]', '');
        $I->seeLink('< Назад');
        $I->see('Продолжить >');


        //check form validation
        $I->fillField('InstallForm[userName]', 'yupe');
        $I->fillField('InstallForm[userEmail]', 'yupe');
        $I->fillField('InstallForm[userPassword]', '111111');
        $I->fillField('InstallForm[cPassword]', '111');
        $I->click('Продолжить >');
        $I->see('Необходимо исправить следующие ошибки', \CommonPage::ERROR_CSS_CLASS);
        $I->see('Пароли не совпадают!', \CommonPage::ERROR_CSS_CLASS);
        $I->see('Email не является правильным E-Mail адресом.', \CommonPage::ERROR_CSS_CLASS);

        $I->fillField('InstallForm[userEmail]', 'yupe@yupetest.ru');
        $I->fillField('InstallForm[cPassword]', '111111');
        $I->click('Продолжить >');
        $I->dontSee('Необходимо исправить следующие ошибки', \CommonPage::ERROR_CSS_CLASS);

        $I->seeInCurrentUrl('sitesettings');
        $I->see('Шаг 7 из 8 : "Настройки проекта"', 'span');
        $I->checkOption('InstallForm[theme]', 'default');
        $I->seeInField('InstallForm[siteName]', 'Юпи!');
        $I->seeInField('InstallForm[siteDescription]', 'Юпи! - самый простой способ создать сайт на Yii!');
        $I->seeInField('InstallForm[siteKeyWords]', 'Юпи!, yupe, цмс, yii');
        $I->seeInField('InstallForm[siteEmail]', 'yupe@yupetest.ru');
        $I->seeLink('< Назад');
        $I->see('Продолжить >');


        // check finish
        $I->click('Продолжить >');
        $I->seeInCurrentUrl('finish');
        $I->see('Шаг 8 из 8 : "Окончание установки', 'span');
        $I->see('Поздравляем, установка Юпи! завершена!', 'h1');
        $I->seeLink('ПЕРЕЙТИ НА САЙТ');
        $I->seeLink('ПЕРЕЙТИ В ПАНЕЛЬ УПРАВЛЕНИЯ');


        // check site
        $I->amOnPage('/');
        $I->see('Поздравляем!', 'h1');
        $I->seeLink('Разработка и поддержка интернет-проектов');
    }
}