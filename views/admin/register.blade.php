<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta name="token" content="{{ csrf_token() }}"/>
	<meta name="url" content="{{ URL('/') }}"/>
	<title>Datalumni</title>
	<!-- Icons-->
	<link href="{{ asset('css/custom/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('css/custom/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/custom/custom-style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/custom/owl.carousel.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/custom/owl.theme.default.min.css') }}" rel="stylesheet">
	<!-- Latest compiled and minified CSS -->
	<link rel="icon" href="{{asset('images/custom/favicon.png')}}" type="image/gif" sizes="16x16">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	@toastr_css
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
<div class="signup-frm py-5">
	<div class="container-fluid bg-blur ">
		<div class="signup-frm-wrp m-auto">
			<div class=" signup-frm-header clearfix">
				<ul class="mybread d-flex justify-content-between">
					<li class="square square-left bg-gre" id="cr-left">
						<span class="bg-gre step">1</span>
						<p>Activation de votre compte</p>
					</li>
					<li class="square square-center" id="cr-cent">
						<span class="step">2</span>
						<p>Complétion du profil</p>
					</li>
					<li class="square square-right" id="cr-right">
						<span class="step">3</span>
						<p>C'est parti !</p>
					</li>
				</ul>
			</div>
			<div class="clearfix"></div>
			<div class="signup-frm-form mt-5">
				<div class="row">
					<div class="col-md-6 signup-frm-form-lside">
						<div class="signup-frm-form-lside-wrp h-100 w-100 d-table ">
							<div class="d-table-cell align-middle">
								<div class="signup-logo text-center ">
									<a href="{{ route('login.admin.get') }}">
										<img src="{{  asset('images/Schools/' . $schoolInfo->logo) }}">
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 signup-frm-form-rside bg-white">
						<form id="regForm" action="{{ route('register.admin') }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="tab" >
								<div class="">
									<h3 class="text-center">Etape 1</h3>
									<h5 class="text-info">Votre mot de passe doit contenir 12 caractères minimum et inclure majuscules, minuscules, chiffres et caractères spéciaux</h5>
								</div>
								<div class="errors text-danger"></div>
								<div class="form-group mb-2 mt-5">
									@if ($errors->has('password'))
										<p role="alert" class='text-danger'><strong>{{ $errors->first('password') }}</strong></p>
									@endif
									<input type="password" class="form-control" name="password" id="cm-pwd" required="" placeholder="Mot de passe">
								</div>
								<div class="form-group mb-0">
									<input type="password" class="form-control" name="password_confirmation" required="" placeholder="Confirmer le mot de passe">
								</div>
							</div>
							<div class="tab">
								<h3 class="text-center mb-4">Etape 2</h3>
								<div class="div_for_survey_1">
									<div class="question_3_v2_q1 class_for_display_none">
										<div class="form-group">
											<h5 class="text-info">Quel est l’intitulé de votre poste ?
											</h5>
											<input class="form-control" name="title_of_the_post">
										</div>
									</div>
									<div class="question_4_v3_q2 class_for_display_none">
										<div class="form-group">
											<h5 class="text-info">Vous travaillez également au sein de l’administration de l’école, quel est l’intitulé de votre poste ?
											</h5>
											<div class="form-group">
												<input type="text" class="form-control" >
											</div>
										</div>
									</div>
									<div class="question_5_v3_q3 class_for_display_none">
										<div class="form-group">
											<h5 class="text-info">Décrivez brièvement vos missions</h5>
											<div class="form-group">
												<input type="text" name="describe_mission">
											</div>
										</div>
									</div>
									<div class="question_6_v3_q4 class_for_display_none">
										<div class="form-group">
											<h5 class="text-info">Souhaitez-vous renseigner votre parcours académique ?
											</h5>
											<div class="form-group">
												<p>
													<label for="know_academic_background_yes">Oui</label>
													<input value="yes"  data-type="1" type="radio" id="know_academic_background_yes" name="know_about_academic_background">
												</p>
												<p>
													<label for="know_academic_background_no">Non</label>
													<input value="no"  data-type="2" type="radio" id="know_academic_background_no" name="know_about_academic_background">
												</p>
											</div>
										</div>
									</div>
									<div class="question_8_v1_p1 class_for_display_none">
										<div class="form-group diplom_content">
											<h5 class="text-info">indiquer l'intitulé de votre diplôme</h5>
											<div class="form-group">
												<input type="text" name="diplom" class="form-control">
											</div>
										</div>
									</div>
									<div class="question_9_v1_p1_q1 class_for_display_none">
										<div class="form-group">
											<h5 class="text-info">Dans quel établissement avez-vous réalisé ce diplôme ?</h5>
											<div class="form-group div_for_multiple">
												<select name="institution" id="institution" class='form-control  w-100' required="">
													<option value="" checked >Choose Institution</option>
													@foreach(App\Institution::all() as $institution)
														<option >{{$institution->name}}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
									<div class="question_10_v1_p1_q2 class_for_display_none">
										<div class="form-group">
											<h5 class="text-info">En quelle année avez-vous été diplômé·e ?</h5>
											<div class="form-group div_for_multiple">
												<select name="graduation_year" id="graduation_year_survey_3" class='form-control w-100 multiple' required="">
													<option value="" >Graduation Years</option>
													@foreach(App\GraduationYear::all() as $graduationyear)
														<option >{{$graduationyear->year}}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
									<div class="question_from_avatar class_for_display_none">
										<div class="form-group">
											<p>
												<label for="user_avatar">Upload Your Image</label>
												<input  type="file" id="user_avatar" class="form-control" name="user_avatar">
											</p>

										</div>
									</div>
								</div>
								<div class="div_for_thanks_message text-danger">

								</div>
							</div>
							<div style="overflow:auto;">
								<div style="float:right;margin-top: 10px;" class="div_for_regForm_btns class_for_display_none">
									<button type="button " class="btn btn-theme-x pagination_button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
									<button type="button" class="btn btn-theme-x pagination_button" id="nextBtn" onclick="nextPrev(1)">Next</button>
								</div>
							</div>
							<div style="overflow:auto;">
								<div style="float:right;margin-top: 10px;" class="div_for_survey_next ">
									<button type="button" class="btn btn-theme-x btn_for_next_question"  onclick="nextPrev(1)">Question suivante</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>


</body>

<script>
    $(document).ready(function() {
        first_quest = 1
        first_quest_type = 1
        $(document).on('click',".btn_for_next_question",function(){
            if( first_quest == 1){
                $(".question_3_v2_q1").slideDown(0);
                first_quest++
            }
            var third_quest = $(".div_for_survey_"+first_quest_type + " input[name='title_of_the_post']" ).val();
            if(third_quest){
                $(" .question_3_v2_q1").slideUp(0);
                $(' .question_5_v3_q3').slideDown(0);
                var four_quest = $(" input[name='describe_mission']" ).val();
                if(four_quest){
                    $(" .question_5_v3_q3").slideUp(0);
                    $(' .question_6_v3_q4').slideDown(0);
                    var five_quest_type = $(" input[name='know_about_academic_background']:checked" ).data('type');
                    if(five_quest_type == '1'){
                        $(" .question_6_v3_q4").slideUp(0);
                        $(' .question_8_v1_p1').slideDown(0);
                        if( $("input[name='diplom']").val() != ''){
                            $(" .question_8_v1_p1").slideUp(0);
                            $(' .question_9_v1_p1_q1').slideDown(0);
                            var seven_quest = $(" #institution" ).val();
                            if(seven_quest){
                                $(" .question_9_v1_p1_q1").slideUp(0);
                                $(' .question_10_v1_p1_q2').slideDown(0);
                                var eight_quest = $("#graduation_year_survey_3" ).val();
                                if(eight_quest){
                                    $(' .question_10_v1_p1_q2' ).slideUp(0);
                                    $(".question_from_avatar").slideDown(0);
                                    if ($("#user_avatar")[0].files.length != 0 ) {
                                        $(".question_from_avatar").slideUp(0);
                                        $(".btn_for_next_question").slideUp(0);
                                        $('.div_for_thanks_message').append("Et voilà c’est fini ! Merci beaucoup pour votre patience. Vous avez désormais toutes les cartes en main pour profiter de la plateforme.");
                                        submitForm()
                                    }
                                }
                            }
                        }
                    }
                    else if(five_quest_type == '2'){
                        $(' .question_6_v3_q4' ).slideUp(500);
                        $(".question_from_avatar").slideDown(0);
                        if ($("#user_avatar")[0].files.length != 0 ) {
                            $(".question_from_avatar").slideUp(0);
                            $(".btn_for_next_question").slideUp(0);
                            $('.div_for_thanks_message').append("Et voilà c’est fini ! Merci beaucoup pour votre patience. Vous avez désormais toutes les cartes en main pour profiter de la plateforme.");
                            submitForm()
                        }
                    }
                }
            }
        })
        var windowheight = jQuery(window).height();
        jQuery(".signup-frm ").css("min-height", windowheight + 'px')
    });
    // signup - frm

    $('#date').change(function () {
        $(this).removeClass("placeholderclass");
    });


    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab


    function submitForm(){
        setTimeout(function(){
            $("#regForm").submit();
        }, 3000);
    }

    function showTab(n) {
        // if(n == 0){
        //     $('#etape2_time').attr('access','true')
        //     time30(Number($('#etape2_time').html()))
        // }else{
        //     time30(Number($('#etape2_time').html()),true)
        // }
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        // if (n == (x.length - 1)) {
        //     document.getElementById("nextBtn").innerHTML = "Submit";
        // } else {
        //     document.getElementById("nextBtn").innerHTML = "Next";
        // }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    // var timesOut = '';
    // function time30(time = null,pause = false) {
    //     if (time == null){
    //         var time = 30
    //     }
    //     if ($('#etape2_time').attr('access') == 'true'){
    //         $('#etape2_time').attr('access','false')
    //         timeOut = setInterval(function(){
    //             time = time -1
    //             $('#etape2_time').text(time)
    //             if(time <= 0){
    //                 window.location.href = $("meta[name='url']").attr('content')+'/register';
    //             }
    //         }, 1000);
    //     }
    //     timesOut = timeOut
    //     if (pause){
    //         clearInterval(timesOut);
    //     }
    // }

    $('.pagination_button').click(function (e) {
        e.preventDefault();
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        $(".div_for_bonjour_name").html("Bonjour " + first_name + " " + last_name);
    })

    function nextPrev(n) {

        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (!validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        // if( currentTab == 0 ){
        //     $(".div_for_regForm_btns").slideUp(100);
        //     $(".div_for_survey_next").slideDown(100);
        // }
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");

        var passwordReg = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{12,50}$/;
        if (currentTab != 2){
            // A loop that checks every input field in the current tab:
            $('input').removeClass("invalid");
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
				if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                }else{
                    $(y[i]).removeClass("invalid");
                }
                if($(y[i]).attr('type') == 'password'){
                    if (!passwordReg.test(y[i].value)) {
                        $('.errors').text('Désolé mais votre mot de passe ne correspond pas aux normes fixées par le RGPD. Celui-ci doit contenir 12 caractères et inclure à minima une majuscule, une minuscule, un chiffre et un caractère spécial. Exemple : Parapluie68!')
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    }
                }

            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
</script>
<script>
    $(document).ready(function(){
        jQuery('.currently-working-wrp input[type=radio][name=Etes-vous-en-poste-actuellemen]').change(function() {
            if (this.value == 'Oui') {
                jQuery('.yes-i-am-working').show();
                jQuery('.no-i-am-working').hide();
            }
            else if (this.value == 'Non') {
                jQuery('.yes-i-am-working').hide();
                jQuery('.no-i-am-working').show();
            }
        });
		setTimeout(function(){
			$(".div_for_multiple>span").css({'width':'100%'})
		},500)
    });
</script>
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{ asset('js/custom/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/custom/wow.min.js') }}"></script>
<script src="{{ asset('js/custom/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/custom/custom.js') }}"></script>
<script src="{{ asset('js/admin/custom.js') }}"></script>

@toastr_js
@toastr_render