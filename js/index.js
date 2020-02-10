

	const addMoreAnswer = document.querySelector('#answer-container');
	const  add = '<div class="ans-elem-cont">\
					<label for="answers">Answer:</label>\
					<textarea class="answer" name="answer"></textarea>\
					<input type="button" class="btn-del-cont" value="X">\
				</div>';
				
	addMoreAnswer.addEventListener('click',function(e){
		if(e.target.className == 'btn-add-moreanswer'){
			//create element
			const div = document.createElement('div');
			const label = document.createElement('label');
			const txtarea = document.createElement('textarea');
			const btn = document.createElement('input');

			//getting the target parent #answer-container
			const grandfather = e.target.parentElement;
			const parent = e.target.parentElement.parentElement;
			//parent.innerHTML += add;

			//adding classes
			div.classList.add('ans-elem-cont');
			btn.classList.add('btn-del-cont');
			txtarea.classList.add('answer');

			//set attribute
			label.setAttribute('for','answers');
			btn.setAttribute('type','button');
			btn.setAttribute('value','X');
			txtarea.setAttribute('name','answer[]');

			//adding text content
			label.textContent = 'Answers:';

			//adding element
			
			div.appendChild(label);
			div.appendChild(txtarea);
			div.appendChild(btn);
			parent.appendChild(div);
			//addMoreAnswer.appendChild(parent);

		}	
		if(e.target.className == 'btn-del-cont'){
			const cont = e.target.parentElement;
			addMoreAnswer.removeChild(cont);

		}
	});


	const btnAddChoice = document.querySelector('.btn-add-choice');
	const choiceContainer = document.querySelector('#choices-container');
	btnAddChoice.addEventListener('click',function(e){
		if(e.target.className == 'btn-add-choice'){
			const div = document.createElement('div');
			const label = document.createElement('label');
			const txtarea = document.createElement('textarea');
			const btn = document.createElement('button');

			label.textContent = 'Choices';
			btn.textContent = 'X';

			div.classList.add('parent');
			txtarea.classList.add('choice');
			txtarea.setAttribute('name','choice[]');
			label.setAttribute('for','choice');
			btn.setAttribute('value','X');


			div.appendChild(label);
			div.appendChild(txtarea);

				if(choiceContainer.hasChildNodes()){
				div.appendChild(btn);
				};

			choiceContainer.appendChild(div);

		}
	});





