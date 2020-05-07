
$( document ).ready(function() {
	$("#addanswer").click(function(){
		const new_ans_container ='<div class="form-group"><label for="answer">Answers</label><textarea id="answer" name="answer[]" class="form-control" spellcheck="false"></textarea></div>';
	  $("#answers-container").append(new_ans_container);
	});

	$("#addtype").click(function(){
		const input_group_type ='<div class="input-group m-2"><input type="text" name="question_type[]" class="form-control" placeholder="Enter New Question Type" aria-label="Question Type" aria-describedby="basic-addon2"><div class="input-group-append"><button class="btn btn-outline-secondary" type="button">Icon</button><button class="btn btn-outline-primary" type="button">Template</button><button class="btn btn-outline-danger" id="btn-remove-type" type="button">Remove</button></div></div>'
		$(".card-body").append(input_group_type);
	});

	$("#addcategory").click(function(){
		const input_group_type ='<div class="input-group m-2"><input type="text" name="category[]" class="form-control" placeholder="Enter New Category" aria-label="Question Type" aria-describedby="basic-addon2"><div class="input-group-append"><button class="btn btn-outline-secondary" type="button">Icon</button><button class="btn btn-outline-danger" type="button">Remove</button></div></div>'
		$(".card-body").append(input_group_type);
	});

	$("#add_question_type_container").on("click",function(event){
		if(event.target.id == 'btn-remove-type'){
			const trgt_id = event.target.id;
			$("#"+trgt_id).closest(".input-group").remove();
		}

		if(event.target.className == 'btn btn-outline-primary'){
			alert("Sorry No Template for now, Template is set to default Identification");
		}
	});
});

window.onload = function(){
	/*console.log("wee");*/

	let http = new XMLHttpRequest();

	http.onreadystatechange = function(){
		if(http.readyState == 4 && http.status == 200){
			//console.log(JSON.parse(http));
			//console.log(http.responseText);
		}
	}
	http.open("GET","./data/sample.json",true);
	http.send();

	//console.log(http);
} 
