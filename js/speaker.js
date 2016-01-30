//JS module for speaker app

var BASE_URL_DICT = 'http://www.wordreference.com/definizione/';
var BASE_URL = 'www.wordreference.com';
var PRON_CLASS = '.Pron';
var ENTRY_CLASS = '.entryitit';
var SINGLE_DEF_CLASS = '.Definition';
var MULTI_DEF_CLASS = '.definition';

var separators = [',',' ',';','\\.','\\!','\\?','\\n','\\"','\\\''];
var separators_str = ', ;.!?\n"\'';

var currentTask = {
    words : [],
    translations : [],
    processed_words : 0,
    get_current_word: function() {
	if (this.words.length > this.processed_words) {
	    return this.words[this.processed_words];
	}
	else
	    return null;
    },
    push_result: function(res) {
	this.processed_words++;
	this.translations.push(res);	
    },
    get_progress: function() {
	if (this.processed_words == 0)
	    return 0;
	else {
	    var res = this.processed_words / this.words.length;
	    res = Math.floor(res * 100);
	    return res;
	}
    }
};

function translate() {
    $('#wait-modal').modal();
    var text = $('#ta-text').val();
    var regexp = '(' + separators.join('|') + ')';
    var re =  new RegExp(regexp);
    var tokens = text.split(re);
    resetTask();
    tokens.forEach(updateTask);

    runTaskStep();
}

function runTaskStep() {
    var word = currentTask.get_current_word();
    var url = BASE_URL_DICT + word;
    if (word == null) {
	completeTask();
    }
    else if (separators_str.indexOf(word) > 0) {
	var res = getEmptyItem(word);
	currentTask.push_result(res);
	runTaskStep();
    }
    else {    
	$.ajax(url, {
	method : "GET",
	    dataType : "html",
	    success : succHandler,
	    error : errHandler 
	});
    }
}


function completeTask() {
    updateProgressbar();
    $('#wait-modal').modal('hide');
    $('#input-text').addClass('hide');
    $('#output-resp').removeClass('hide');
    
    for (var t = 0; t < currentTask.translations.length; t++){
	var text = "";
	var trans = currentTask.translations[t];
	var elem = $('<span>');
	if (separators_str.indexOf(trans.word) < 0) {
	    elem.addClass('word-label');	
	    if (trans.pron != null && trans.pron.length > 0) {
		for (var p = 0; p < trans.pron.length; p++) {
		    var subelem = $('<span>');
		    var tmp = trans.pron[p].pron;
		    if(tmp == "") tmp = trans.word;
		    subelem.html(tmp);
		    subelem.addClass('translated');
		    subelem.attr('data-id-word', t);
		    subelem.attr('data-id-pron', p);
		    elem.append(subelem);
		}
	    }
	    else {
		elem.html(trans.word);
	    }
	}
	else {
	    elem.html(trans.word);
	}

	$('#div-res').append(elem);
    }

    $('.translated').click(loadDefinition);
}


function succHandler(data) {
    var res = processRes(data);
    currentTask.push_result(res);
    updateProgressbar();
    
    runTaskStep();

    
}

function updateProgressbar() {
    var progr = currentTask.get_progress();
    $('#progress').css('width', progr + "%");
}


function getEmptyItem(word) {
    var item = {
	word: word,
	audio: null,
	pron: null
    };
    return item;
}

function processRes(data) {
    data = data.replace(/<img[^>]*>/g,"");
    htmlObj = $(data);
    var res = null;
    var audio = null;
   
    var elems = htmlObj.find(ENTRY_CLASS);
    if (elems.length > 0) res = [];
    for (var e = 0; e < elems.length; e++) {	
	var item = processEntry(elems.eq(e))
	res.push(item);
    }
    var audio_elems = htmlObj.find('audio');
    if (audio_elems.length > 0) {
	audio = audio_elems[0];
    }

    audio_item = audio;
    var item = {
	word : currentTask.get_current_word(),
	audio : audio,
	pron : res
    };
    
    return item;
}

function loadDefinition() {
    var cont = $('#definitions');
    cont.empty();
    var elem = $(this);
    var idw = elem.attr('data-id-word');
    var idp = elem.attr('data-id-pron');

    var word = currentTask.translations[idw].word;
    var audio = currentTask.translations[idw].audio;
    var item = currentTask.translations[idw].pron[idp];
    var pron = item.pron;
    for (var d = 0; d < item.definitions.length; d++) {
	var p = $('<p>');
	p.html(item.definitions[d]);
	cont.append(p);
	cont.append($('<hr>'));
    }
    
    $('#word-title').html(word + " " + pron + " ");
    $('#word-title').attr('data-id-word', idw);
    if(audio != null) {
	var icon = $('<i>');
	icon.addClass('fa');
	icon.addClass('fa-volume-up');
	$('#word-title').append(icon);
    }
    $('#def-modal').modal();
}

function handlerAudio() {
    var elem = $(this);
    var idw = elem.attr('data-id-word');
    if (idw != null || idw != "") {
	var audio = currentTask.translations[idw].audio;
	if (audio != null)
	    playAudio(audio);
    }
}


function playAudio(audio_item) {
    var audio = null;

    var src = audio_item.currentSrc;
    src = src.substr(src.indexOf('/audio'));
    src = 'http://' + BASE_URL + src;
 
    audio = new Audio(src);
    audio.play(audio);
    return audio;
}

function processEntry(entry) {
    var pron = null;
    var definitions = [];
    var pron_elems = entry.find(PRON_CLASS);
    var tmp_arr = [];
    for (var p = 0; p < pron_elems.length; p++) {
	tmp_arr.push(pron_elems.eq(p).text());
    }
    pron = tmp_arr.join(' | ');
    
    var def = entry.find(SINGLE_DEF_CLASS).text();
    if (def != "") {
	definitions.push(def);
    }
    else {
	var def_items = entry.find(MULTI_DEF_CLASS);
	for (var d = 0; d < def_items.length; d++) {
	    var def_text = def_items.eq(d).text();
	    definitions.push(def_text);
	}	
    }

    var res = {
	pron : pron,
	definitions : definitions
    };

    return res;
}

function errHandler(data) {
    console.log('ERROR');
    console.log(data);
}


function resetTask () {    
    currentTask.words = [];
    currentTask.processed_words = 0;
    currentTask.translations = [];

    updateProgressbar();
    $('#div-res').empty();
    $('#output-resp').addClass('hide');
    $('#input-text').removeClass('hide');
    $('#ta-text').focus();
}


function updateTask(token) {
    currentTask.words.push(token);	
}



$(document).ready(function() {
    $('#btn-translate').click(translate);
    $('#btn-back').click(resetTask);
    $('#word-title').click(handlerAudio);
    $('#ta-text').focus(function() {$(this).select()})
    $('#ta-text').focus();
});
