<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
      Speaker
    </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css"/>

    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script src="js/speaker.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="header clearfix">
	<nav>
	  <ul class="nav nav-pills pull-right">
	    <li role="presentation">
	      <a href="#"
		 data-toggle="modal"
		 data-target="#info-modal">Come funziona?</a>
	    </li>
	  </ul>
	  <h3><i class="fa fa-volume-up"></i>
	    Speaker</h3>
	  <hr>
	</nav>
      </div>
      <div class="section" id="input-text">
	<div class="row">
	  <div class="col-sm-12 col-md-offset-2 col-md-8">
	    <div class="panel panel-default">
	      <div class="panel-heading">
		<i class="fa fa-file-text-o"></i>
		Inserisci qui il testo che non sai pronunciare:
	      </div>
	      <div class="panel-body">
		<textarea id="ta-text"
			  class="form-control"
			  rows="15"
              placeholder="Ad es: Rasoio del camoscio"></textarea>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="row">
	  <div class="col-md-12 text-center">
	    <button class="btn btn-lg btn-success" id="btn-translate">
	      <i class="fa fa-comment"></i>
		Pronuncia!
	    </button>
	  </div>
	</div>
      </div>

      <div class="section hide" id="output-resp">
	<div class="row">
	  <div class="col-sm-12 col-md-offset-2 col-md-8">
	    <div class="panel panel-default">
	      <div class="panel-heading">
		<i class="fa fa-comment"></i>
		Ecco come dovresti pronunciarlo
	      </div>
	      <div class="panel-body">
		<div id="div-res"></div>
	      </div>
	    </div>
	  </div> 	    	    
	</div>
	<div class="row">
	  <div class="col-md-12 text-center">
	    <button class="btn btn-lg btn-warning" id="btn-back">
	      <i class="fa fa-arrow-left"></i>
		Prova con un altro testo
	    </button>
	  </div>
	</div>
      </div>
      
      
      <div class="footer">
	<hr>
	<p class="text-info">
	  <i class="fa fa-smile-o"></i>
	  Beh, se funziona meglio cos&igrave;... se no pazienza
	</p>
      </div>



      <div class="modal fade"
	   id="wait-modal"
	   tabindex="-1"
	   role="dialog"
	   backdrop="static">
	<div class="modal-dialog modal-sm">
	  <div class="modal-content">
	    <div class="modal-body text-center">
              <h4>Un attimo di pazienza... <i class="fa fa-smile-o"></i>
	      </h4>
	      <div class="progress">
		<div class="progress-bar progress-bar-striped active" id="progress"
		     role="progressbar"
		     aria-valuenow="0"
		     aria-valuemin="0"
		     aria-valuemax="100"
		     style="width: 0%;">
		</div>
	      </div>
	    </div>	    
	  </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
      </div><!-- /.modal -->


      <div class="modal fade"
	   id="def-modal"
	   tabindex="-1"
	   role="dialog">
	<div class="modal-dialog">
	  <div class="modal-content">
	    <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="word-title"></h4>
	    </div>	    	    
	    <div class="modal-body">
	      <div id="definitions">
	      </div>	      
	    </div>	    
	  </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      
      <div class="modal fade"
	   id="info-modal"
	   tabindex="-1"
	   role="dialog">
	<div class="modal-dialog">
	  <div class="modal-content">
	    <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">O meglio, come non funziona...</h4>
	    </div>	    	    
	    <div class="modal-body">
	      <p>
		Benvenuti in Speaker, che in realt&agrave; volevo chiamare
		RoboticSilvia o qualcosa del genere, ma poi mi &egrave;
		sembrato indelicato.
	      </p>
	      <p>
		Questo semplice servizio ti permette
		di ottenere da un dizionario la pronuncia corretta di
		tutte le parole che compongono un testo.
	      </p>
	      <p>
		Figo eh?
	      </p>
	      <p>
		Per facilitarmi un po' la vita ho scelto di utilizzare
		<a href="http://wordreference.com/definizione"
		   target="_blank">
		  WordReference.com
		</a>
		come dizionario di base.
		Utilizzare il DOP sarebbe stato un mezzo dramma, per via
		di una serie di succulenti dettagli tecnici che vi risparmio.
	      </p>
	      <p>
		Ora, WordReference funziona abbastanza bene, per alcune
		(poche) parole ha addirittura l'audio.
		Purtroppo non riesce a dare la pronuncia corretta dei verbi
		coniugati, d'altronde mi sembra che nemmeno il DOP lo faccia.
		Quello che riesce a fare è risalire all'infinito di un
		qualsiasi verbo, ossia se gli passo 'credette' lui mi porta
		ai risultati del verbo 'credere', per&ograve; chiaramente
		non mi da informazioni sulla pronuncia di 'credette'.
	      </p>
	      <p>
		Altra cosa, se cercate una parola con più significati,
		nel mostrare i risultati li espongo tutti, in modo che siate
		voi a contestualizzare e capire qual &egrave; la parola che
		stavate cercando. Insomma, mica posso fare tutto io.
	      </p>
	      <p>
		Nella visualizzazione dei risultati, se premete su uno dei
		significati di una parola, vi vengono fornite le definizioni
		e, se disponibile, l'audio della pronuncia corretta.
	      </p>
	      <p>
		Bene, pi&ugrave; o meno questo &egrave; quanto, have fun!
	      </p>
	    </div>	    
	  </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      
    </div>   
  </body>
</html>


