<?php
use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('hello');  // Domyślna strona główna
App::getRouter()->setLoginRoute('login');   // Trasa logowania

// Wyświetlenie głównej strony 
Utils::addRoute('hello',                'HelloCtrl');

// Logowanie do systemu
Utils::addRoute('login',                'LoginCtrl');

// Wylogowanie z systemu
Utils::addRoute('logout',               'LogoutCtrl');

// Dodawanie nowego użytkownika 
Utils::addRoute('register',             'RegisterCtrl');

// Wynajem samochodów
Utils::addRoute('rentals',              'RentalsCtrl');

// Wyświetlenie profilu użytkownika
Utils::addRoute('profile',              'ProfileCtrl');

// Wyświetlenie formularza do rejestracji pojazdu
Utils::addRoute('vehicles',             'VehiclesCtrl');

// Wyświetlanie listy pojazdów zarejestrowanych od użytkownika 
Utils::addRoute('vehiclesList',         'VehiclesListCtrl');

// Administrator
Utils::addRoute('adminPanel',           'AdminCtrl');

// Wyświetlenie pojazdów użytkowników przez administratora
Utils::addRoute('userVehicles',         'AdminCtrl');

// Możliwość usunięcia użytkowników przez administratora
Utils::addRoute('deleteUser',           'AdminCtrl');





// Trasy warsztatu
//Utils::addRoute('warsztat',             'WorkShopCtrl');
//Utils::addRoute('warsztat/czesci',      'WorkShopCtrl');

// Trasy biurowe
//Utils::addRoute('biuro',                'OfficeCtrl');
//Utils::addRoute('biuro/zamowienia',     'OfficeCtrl');




