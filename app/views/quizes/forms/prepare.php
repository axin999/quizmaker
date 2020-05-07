<?php
use Core\FH;
use Core\HP;
use Core\Auth;
?>
<form action="<?php if(property_exists($this, "postQuizAction")) echo $this->postQuizAction; ?>" method="POST" class="form-block">
  <div class="row justify-content-center align-items-center p-3">
  	<div class="col col-md-8">
  		<div class="card text-white bg-light mb-3 text-dark">
  		  <div class="card-body justify-content-center align-items-center">
  			
  				<?= FH::csrfInput() ?>
  				<?= FH::inputBlock("text","Quiz Name:","quiz_name","",["class"=>"form-control mb-4 mr-sm-2"],"",["class"=>"mr-sm-2 w-100 text-center"]) ?>
          <?= FH::textArea("Quiz Description:","quiz_description","",["class"=>"form-control mb-4 mr-sm-2"],["class"=>"mr-sm-2 w-100 text-center"]) ?>

          <?php if(Auth::check()):?>
  				<input type="button" name="btn_auto_generate" value="Auto Generate" class="btn btn-primary mr-sm-2 w-100 mt-2 text-center" data-toggle="modal" data-target="#autoGenerateModal">
          <?php endif; ?>

          <div class="container-fluid bg-white p-4 mt-3" id="added_question_container">
            <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Enter your question">
              <div class="input-group-append">
                <select class="btn btn-outline-secondary" id="sel1">
                    <option>Category</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
              </div>
            </div>
              <input class="form-control w-75 mt-2 mx-auto" type="text" placeholder="Add your answer">
            </div>
          </div>

          <input type="button" name="btn_add_question" value="Add Question" class="btn btn-success mr-sm-2 w-100 mt-2 text-center" data-toggle="modal" data-target="#addQuestionModal"> 

  		  </div>
  		  <div class="card-footer bg-transparent border-success">
          <div class="button-group float-right">
            <?= FH::button("Preview",["class"=>"btn btn-primary"]);  ?>
            <?= FH::button("Create",["class"=>"btn btn-primary","type"=>"submit"]);  ?>          
          </div>
        </div>
  		</div>	
  	</div>
  </div>
</form>
<!-- Modal Add Question -->
<div class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">New</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Stored Question</a>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="row" id="question_type_choice_container">
              <?php foreach($this->question_types as $question_type): ?>
                  <div class="col col-md-6 btn btn-outline-primary"><?= $question_type->question_type_name ?></div>
              <?php endforeach;?>
            </div>
          </div>
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="row" id="usee_question_choice"> </div>
          </div>
        </div>





      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Genarate</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Auto Generate -->
<div class="modal fade" id="autoGenerateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form>
	       <?= FH::inputBlock("text","Number of Questions:","quiz_count","",["class"=>"form-control mb-4 mr-sm-2"],"",["class"=>"mr-sm-2 w-100 text-center"]) ?>
		    <fieldset class="form-group row">
		    <legend class="col-form-legend col-sm-2">Category</legend>
		      <label class="col-sm-2">Checkbox</label>
		      <div class="col-sm-10">
		        <div class="form-check">
		          <label class="form-check-label">
		            <input class="form-check-input" type="checkbox"> Check me out
		          </label>
		        </div>
		      </div>
	       </fieldset>

		    <fieldset class="form-group row">
		    <legend class="col-form-legend col-sm-2">Types</legend>
		      <label class="col-sm-2">Checkbox</label>
		      <div class="col-sm-10">
		        <div class="form-check">
		          <label class="form-check-label">
		            <input class="form-check-input" type="checkbox"> Check me out
		          </label>
		        </div>
		      </div>
	       </fieldset>
      		
      	</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Genarate</button>
      </div>
    </div>
  </div>
</div>