$(document).ready(function(){

	// Initialise drop downs.
	$(".input-chosen-select").chosen({
		disable_search: true,
		width: '100%'
	}).change(function(){
		formValidation.tick($(this));
	});

    // Simple list (Ordeable list field)
    // Check to see if it even exists first.

    if ($('#simpleList').length) {
	    Sortable.create(simpleList, {
	    	animation: 150,
		    onUpdate: function (evt) {
				checkBoxes(evt.item);
		    }
	    });

	    function checkBoxes(elem) {
	    	// Update the relevent checkbox based on the index of each list item.
	    	$('#simpleList').children().each(function(){
	    		var self = $(this);
	    		self.find('input[value="'+(self.index() + 1)+'"]').prop("checked", true);
	    	});
	    }
	}

	// Basic text validation so we can tick the form as we go along.
	// (Needs some looking at, how do we validate toggle switches ?)
    $('.input-basic-text').on('input', function() {
		formValidation.text($(this));
	});

    $('[data-toggle-hidden]').on('click', function(){
    	var hiddenDiv = '[data-toggle-hidden-target="' + $(this).data('toggle-hidden')+'"]';

    	if ($(hiddenDiv).hasClass('hidden')){
			$(hiddenDiv).addClass('animating');
			$(hiddenDiv).toggleClass('hidden');
	    	setTimeout(function(){
				$(hiddenDiv).removeClass('animating');
	    	},10);
    	} else {
			$(hiddenDiv).addClass('animating');
	    	setTimeout(function(){
				$(hiddenDiv).toggleClass('hidden');
				$(hiddenDiv).removeClass('animating');
	    	},300)
    	}
	});

	/*
		Form Field Cloning functionality on question 18 and 13a.

		Duplicate the inputs, wipe any data and update the classes/names so it gets counted as
		a new input when submitting the form.

	*/

	// Add new row
	$('.js-clone-add').on('click', function(e){
		e.preventDefault();
		var $originalRow = $(this).parent().siblings('.js-clone-row');
		var $clonedRow = $originalRow.clone();
		var currentRows = $originalRow.data('cloned-rows');

		if (currentRows === undefined) {
			currentRows = 2;
		} else {
			currentRows = currentRows + 1;
		}

		$originalRow.data('cloned-rows', currentRows);

		$clonedRow.removeClass('js-clone-row');
		$clonedRow.addClass('js-clone-row-' + currentRows);
		$clonedRow.find('.chosen-container').remove();

		$(this).parent().before($clonedRow);
		// Clear any text input values
		$clonedRow.find('input').val('');
		// home-heating-extra-1
		$clonedRow.find('select, input').each(function(){
			var previousRowName = $(this).attr('name');
			previousRowName = previousRowName.substring(0, previousRowName.length - 1);
			currentRowName = previousRowName + currentRows;
			$(this).attr('name', currentRowName);
		});
		// Initialise chosen
		$clonedRow.find('select').chosen({
			disable_search: true,
			width: '100%'
		});
	});

	// Remove row
	$('.js-clone-remove').on('click', function(e){
		e.preventDefault();

		var $originalRow = $(this).parent().siblings('.js-clone-row');
		var currentRows = $originalRow.data('cloned-rows');
		if (currentRows == 1 || currentRows === undefined) {
			return false;
		} else {
			var $currentSelect = $(this).parent().siblings('.js-clone-row-'+currentRows);
			$currentSelect.remove();
			currentRows = currentRows - 1;
			$originalRow.data('cloned-rows', currentRows);
		}

	});


	// Submit form
	$('.js-form-submit').on('click',function(e){
		// e.preventDefault();
		// console.log($('form').serializeObject());
		// alert(JSON.stringify($('form').serializeObject()));
	});

});

// Just for debugging if all the fields are being passed through. (Saves me trawling through a URL)
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};


var formValidation = (function(){
	var debug = false;

	var init = function(){
		console.log('init');
	};

	var checkTextValidation = function(context){
		// Run validation
		var val = context.val();

		if (textValidation(val)) {
			if (!inputAlreadyTicked(context)) {
				tickInput(context);
			}
		} else {
			unTickInput(context);
		}

	}

	var numberValidation = function(context){
		// Check if all/any of the numbers have been filled in ?
	}

	var textValidation = function(val){
		/*
			This is just an example of what we could put here to make sure
			that the user interacted/entered the correct data.

			Not sure what we can do for the orderable list/toggle buttons,
			user might leave them in their default states. If they do and
			the question isn't ticked off the user might think that they
			didn't fill the question in properly.

			Andy suggested if the user interacts with a field on the form
			that comes after one of these fields then we mark it as verified.

			Another option is to wait until the end to show the validation on
			everything.
		*/
		if (val != '') {
			return true;
		} else {
			return false;
		}
	}

	var tickInput = function(context){
		context.closest('.input-field').addClass('complete');
		if (debug){console.log('input ticked')}
	}

	var unTickInput = function(context){
		context.closest('.input-field').removeClass('complete');
		if (debug){console.log('input unticked')}
	}

	var inputAlreadyTicked = function(context) {
		if (context.closest('.input-field').hasClass('complete')){
			if (debug){console.log('input already ticked')}
			return true;
		} else {
			return false;
		}
	}

	return {
		init: init,
		text: checkTextValidation,
		tick: tickInput,
		untick: unTickInput
	}

 })();