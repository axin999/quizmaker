
//let quizContainer = document.querySelector('#quiz-container');
const createBtn = document.getElementById('create');

let counter = 0;
let answers = [];
let answerObj = new Answer();
let question = new Question();
console.log(question.quizContainer);

createBtn.addEventListener('click',(e)=>{
	e.preventDefault();
	let limitQuestion = document.getElementById('question-limit').value;
	console.log(limitQuestion);
	var getquiz = get('create_quiz.php?quiz&limit='+limitQuestion);
	getquiz.then((data)=>{
		console.log(data);
		let dataArrayVal = Object.values(data);
		console.log('dataArrayVal',dataArrayVal);
		dataArrayVal[counter].forEach(element =>{
			question.createinputs(element.question_id,element.answer_id,element.question);
		});
		question.nextbutton();
		counter++;

		question.quizContainer.addEventListener('click',function(e){
			
		if(e.target.className == 'next-button'){
			
			e.preventDefault();

/*				Answer.prototype.getanswer = document.querySelectorAll('.useranswer').forEach(element =>{
					answerObj.stackAnswer(element.dataset.questionid,element.answer_id,element.question);
				
				});*/

				for(let i = 0; i < answerObj.getanswer.length; i++){
					let questionid = answerObj.getanswer[i].dataset.questionid;
					let answerid = answerObj.getanswer[i].dataset.answerid;
					let useranswer = answerObj.getanswer[i].value;
					console.log('getanswer',answerObj.getanswer[i]);
					answerObj.stackAnswer(questionid,answerid,useranswer);
				};
				
			if(counter < dataArrayVal.length){
				question.removeinputs();

				let questionid = dataArrayVal[counter][0].question_id;
				let answerid = dataArrayVal[counter][0].answer_id;

				console.log('answerObj',answerObj.userAnswers);
				//answers.push({question_id:data[counter].question_id,user_answer:answer});
/*				for(let i = 0; i < dataArrayVal[counter].length; i++ ){
					quizInputs2(dataArrayVal[counter][i].question_id,dataArrayVal[counter][i].answer_id,dataArrayVal[counter][i].question);

				};*/
				dataArrayVal[counter].forEach(element =>{
					question.createinputs(element.question_id,element.answer_id,element.question);
				});

				question.nextbutton();
				counter++;
			}

			else{

				let answersString = JSON.stringify(answerObj.userAnswers);
				console.log(answersString);


				let result = post('quiz_result.php','answers='+encodeURIComponent(answersString));
				result.then((data)=>{
					question.showresults(data);
					console.log('data',data);
				}).catch((data)=>{
					console.log('data',data);
				})
				let see = JSON.stringify(answerObj.userAnswers);
				let testing = document.getElementById('testing');
				testing.setAttribute('value',see);
			}
			}
		});


	}).catch(function(data){
		console.log(data);
	});
	// this argument used for none promise async
/*	console.log(getQuizList(function(result){
		console.log(result);
	}));*/
	//console.log(Array.from(quiz));
});







function getQuizList(callbackfunc){
	const xhr = new XMLHttpRequest();
	let data;
	//let params = 
	//let quizList = document.querySelector('#questionList');
		xhr.onreadystatechange = function(){

		if(xhr.readyState == 4 && xhr.status == 200){
			console.log(JSON.parse(xhr.response));
			 data = JSON.parse(xhr.response);
			 console.log(xhr);
/*				data.forEach(function(item,index){
				let td = document.createElement('td');console.log(item.question_id);
					console.log(index);
					td.textContent = item.question;
					quizList.appendChild(td);

				})*/
				
		setTimeout(function() {
		console.log("3. start async operation...")
		console.log("4. finished async operation, calling the callback, passing the result...")
		// 4. Finished async operation,
		//    call the callback passing the result as argument
		callbackfunc(data);
		}, Math.random() * 2000);
				
		}

	};
	xhr.open('GET','create_quiz.php?quiz',true);
	//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.send();
	//return data;
	

};
//getQuizList();
function get(url){
	return new Promise((resolve,reject)=>{
		let xhr = new XMLHttpRequest();
		xhr.open('GET',url,true);
		xhr.onload = ()=>{
			if(xhr.readyState == 4 && xhr.status == 200){
				console.log(xhr)
				resolve(JSON.parse(xhr.response));
			}
			else{
				reject(xhr.statusText);
			}
		};
		xhr.onerror = ()=>{
			reject(xhr.statusText);
		};

		xhr.send();
	});

};

function post(url,data){
	return new Promise(function(resolve,reject){
		const xhr = new XMLHttpRequest();
		xhr.open('POST',url,true);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onload = ()=>{
			if(xhr.readyState == 4 && xhr.status == 200){
				console.log(xhr);
				resolve(JSON.parse(xhr.response));
			}
			else{
				reject(xhr.statusText);
			}
		};
		xhr.onerror = function(){
			reject(xhr.statusText);
		}
		xhr.send(data);
	});

};


function Question(){
	this.quizContainer = document.getElementById('quiz-container')

	this.createinputs = function(question_id,answer_id,title){
		const perquestion = document.createElement('div');
		const div = document.createElement('div');
		const txtarea = document.createElement('textarea');
		const h4 = document.createElement('h4');
		h4.textContent = title;
		div.classList.add('child-cont');

		txtarea.setAttribute('name','user_answer');
		txtarea.setAttribute('data-questionid',question_id);
		txtarea.setAttribute('data-answerid',answer_id);
		txtarea.setAttribute('class','useranswer');
		div.appendChild(h4);
		div.appendChild(txtarea);
		this.quizContainer.appendChild(div);
	}
	this.nextbutton = function(){
		const nxtBtn = document.createElement('input');
		nxtBtn.setAttribute('type','submit');
		nxtBtn.setAttribute('name','next');
		nxtBtn.setAttribute('value','Next');
		nxtBtn.setAttribute('class','next-button')
		this.quizContainer.appendChild(nxtBtn);

	}
	this.removeinputs = function(){
		//const quizChildNodes = document.querySelector('.child-cont');
		//this.quizContainer.removeChild(quizChildNodes);
		while (this.quizContainer.firstChild) {
 			 this.quizContainer.removeChild(this.quizContainer.firstChild);
		}
		console.log('wetpu',this.quizContainer.firstChild);
	}
	this.logsomething = function(){
		console.log(this.quizContainer);
	}
	this.showresults = function(data){
		const resultContainer = document.getElementById('result-container');
		const scoreContainer = document.getElementById("score-container");
		const theadContent = ["Question","Your Answer","Correct Answer","Result"];
		let score ={};
		let tbl = document.createElement('table');
		let tblr = document.createElement('tr');
		let h2 = document.createElement('h2');
		console.log('frompussy',data);


		for(let content of theadContent){
			let tblh = document.createElement('th');
			tblh.textContent = content;
			tblr.appendChild(tblh);
		};
		tbl.appendChild(tblr);
		resultContainer.appendChild(tbl);
		//console.log('kantoot',data);
		data.forEach(function(elements){
			let tblr = document.createElement('tr');
			for(let property in elements){
				if(property === 'totalquestion' || property === 'correctcount'){

					let newobject= {[property]:elements[property]};
					score = {...score,...newobject};
				}

				else{
					let tbld = document.createElement('td');
					tbld.textContent = elements[property];
					tblr.appendChild(tbld);
					tbl.appendChild(tblr);
					
				}
			};

		resultContainer.appendChild(tbl);

		})

		h2.textContent = "Your Got "+score.correctcount+" Correct Answer Out Of "+score.totalquestion;
		scoreContainer.appendChild(h2);
	}
};

function Answer(){
	this.userAnswers = [];
	this.getanswer = document.getElementsByClassName("useranswer");
	//this.getanswer = document.querySelectorAll(".useranswer");


	this.stackAnswer = function(question_id,answer_id,user_answer){
		this.userAnswers.push({question_id,answer_id,user_answer});
	};
	this.logsomething = () =>{
		console.log('logsomething');
	}
};


