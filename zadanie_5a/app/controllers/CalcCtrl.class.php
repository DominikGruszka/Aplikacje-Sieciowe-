<?php
// W skrypcie definicji kontrolera nie trzeba dołączać żadnego skryptu inicjalizacji.
// Konfiguracja, Messages i Smarty są dostępne za pomocą odpowiednich funkcji.
// Kontroler ładuje tylko to z czego sam korzysta.

require_once 'CalcForm.class.php';
require_once 'CalcResult.class.php';


class CalcCtrl {

	private $form;   //dane formularza (do obliczeń i dla widoku)
	private $result; //inne dane dla widoku

	/** 
	 * Konstruktor - inicjalizacja właściwości
	 */
	public function __construct(){
		//stworzenie potrzebnych obiektów
		$this->form = new CalcForm();
		$this->result = new CalcResult();
	}
	
	/** 
	 * Pobranie parametrów
	 */
	public function getParams(){
		$this->form->kwota_kredytu = getFromRequest('kwota_kredytu');
		$this->form->lata_splaty = getFromRequest('lata_splaty');
		$this->form->oprocentowanie = getFromRequest('oprocentowanie');
	}
	
	/** 
	 * Walidacja parametrów
	 * @return true jeśli brak błedów, false w przeciwnym wypadku 
	 */
	public function validate() {
		// sprawdzenie, czy parametry zostały przekazane
		if (! (isset ( $this->form->kwota_kredytu ) && isset ( $this->form->lata_splaty ) && isset ( $this->form->oprocentowanie ))) {
			// sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
			return false;
		}
		
		// sprawdzenie, czy potrzebne wartości zostały przekazane
		if ($this->form->kwota_kredytu == "") {
			getMessages()->addError('Nie podano kwoty kredytu');
		}
		if ($this->form->lata_splaty == "") {
			getMessages()->addError('Nie podano okresy do spłaty kredytu');
		}
                if ($this->form->oprocentowanie == "") {
			getMessages()->addError('Nie podano oprocentowania');
		}
		
		// nie ma sensu walidować dalej gdy brak parametrów
		if (! getMessages()->isError()) {
			
			// sprawdzenie, czy $x i $y są liczbami całkowitymi
			if (! is_numeric ( $this->form->kwota_kredytu )) {
				getMessages()->addError('Podana wartość nie jest liczbą całkowitą');
			}
			
			if (! is_numeric ( $this->form->lata_splaty )) {
				getMessages()->addError('Podana wartość nie jest liczbą całkowitą');
			}
                        if (! is_numeric ( $this->form->oprocentowanie )) {
				getMessages()->addError('Podana wartość nie jest liczbą całkowitą');
			}
		}
		
		return ! getMessages()->isError();
	}
	
	/** 
	 * Pobranie wartości, walidacja, obliczenie i wyświetlenie
	 */
	public function process(){

		$this->getParams();
		
		if ($this->validate()) {
				
			//konwersja parametrów na int
			$this->form->kwota_kredytu = intval($this->form->kwota_kredytu);
			$this->form->lata_splaty = intval($this->form->lata_splaty);
                        $this->form->oprocentowanie = intval($this->form->oprocentowanie);
			getMessages()->addInfo('Parametry poprawne.');
			
			$miesiace = $lata_splaty * 12;
                        $miesieczna_stopa_oprocentowania = ($oprocentowanie / 100) / 12;

                        if ($miesieczna_stopa_oprocentowania == 0) {
                            $this->result = $kwota_kredytu / $miesiace;
                        } else {
                            $this->result = $kwota_kredytu * ($miesieczna_stopa_oprocentowania * pow(1 + $miesieczna_stopa_oprocentowania, $miesiace)) / (pow(1 + $miesieczna_stopa_oprocentowania, $miesiace) - 1);
                        }

                        $this->result->result = round($this->result, 2); 
                        $this->msgs->addInfo('Wykonano obliczenia.');
		}
		
		$this->generateView();
	}
	
	
	/**
	 * Wygenerowanie widoku
	 */
	public function generateView(){
		//nie trzeba już tworzyć Smarty i przekazywać mu konfiguracji i messages
		// - wszystko załatwia funkcja getSmarty()
		
		getSmarty()->assign('page_title','Kalkulator kredytowy');
		getSmarty()->assign('page_description','Zadanie 5a');
		getSmarty()->assign('page_header','');
					
		getSmarty()->assign('res',$this->result);
		
		getSmarty()->display('CalcView.html'); // już nie podajemy pełnej ścieżki - foldery widoków są zdefiniowane przy ładowaniu Smarty
	}
}
