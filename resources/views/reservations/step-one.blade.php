<x-guest-layout>
<body>

<!-- component -->
<!-- This is an example component -->
<div class="h-screen">

	<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

	<style>
		[x-cloak] {
			display: none;
		}

		[type="checkbox"] {
			box-sizing: border-box;
			padding: 0;
		}

		.form-checkbox,
		.form-radio {
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			-webkit-print-color-adjust: exact;
			color-adjust: exact;
			display: inline-block;
			vertical-align: middle;
			background-origin: border-box;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			flex-shrink: 0;
			color: currentColor;
			background-color: #fff;
			border-color: #e2e8f0;
			border-width: 1px;
			height: 1.4em;
			width: 1.4em;
		}

		.form-checkbox {
			border-radius: 0.25rem;
		}

		.form-radio {
			border-radius: 50%;
		}

		.form-checkbox:checked {
			background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z'/%3e%3c/svg%3e");
			border-color: transparent;
			background-color: currentColor;
			background-size: 100% 100%;
			background-position: center;
			background-repeat: no-repeat;
		}

		.form-radio:checked {
			background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
			border-color: transparent;
			background-color: currentColor;
			background-size: 100% 100%;
			background-position: center;
			background-repeat: no-repeat;
		}
	</style>

	<div x-data="app()" x-cloak>
		<div class="max-w-3xl mx-auto px-4 py-10">

			<div x-show.transition="step === 'complete'" id="complete-div" >

			</div>

			<div x-show.transition="step != 'complete'">
				<!-- Top Navigation -->
				<div class="border-b-2 py-4">
					<div class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight" x-text="`Step: ${step} of 3`"></div>
					<div class="flex flex-col md:flex-row md:items-center md:justify-between">
						<div class="flex-1">
							<div x-show="step === 1">
								<div class="text-lg font-bold text-gray-700 leading-tight">Reservation Information</div>
							</div>

							<div x-show="step === 2">
								<div class="text-lg font-bold text-gray-700 leading-tight">Make your reservation</div>
							</div>

							<div x-show="step === 3">
								<div class="text-lg font-bold text-gray-700 leading-tight">Confirm</div>
							</div>
						</div>

						<div class="flex items-center md:w-64">
							<div class="w-full bg-white rounded-full mr-2">
								<div class="rounded-full bg-green-500 text-xs leading-none h-2 text-center text-white" :style="'width: '+ parseInt(step / 3 * 100) +'%'"></div>
							</div>
							<div class="text-xs w-10 text-gray-600" x-text="parseInt(step / 3 * 100) +'%'"></div>
						</div>
					</div>
				</div>
				<!-- /Top Navigation -->

				<!-- Step Content -->
				<div class="py-10">
                    <form id="reservation-form-id" method="POST" action="{{ route('reservation.store') }}" >
                        @csrf
					<div x-show.transition.in="step === 1">
                        <div class="container bg-gray-100 m-3 my-10  px-8 py-20 rounded-lg">
                         <div class="grid md:grid-cols-2 md:gap-6">

                            <div class="relative z-0 mb-6 w-full group">
                                <input   type="text" name="first_name" id="first_nameid" class=" @error('first_name')  border-red-400 @enderror  block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " >
                                <label for="first_nameid" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First name</label>
                                <span class="text-red-500 error-text first_name_error"></span>
                            </div>
                            <div class="relative z-0 mb-6 w-full group">
                                <input   type="text" name="last_name" id="last_nameid" class="@error('last_name')  border-red-400 @enderror  block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " >
                                <label for="last_nameid" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last name</label>
                                <span class="text-red-500 error-text last_name_error"></span>

                            </div>
                        </div>
                        <div class="relative z-0 mb-6 w-full group">
                            <input   type="email" name="email" id="emailid" class=" @error('email') border-red-400 @enderror block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " >
                            <label for="emailid" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
                            <span class="text-red-500 error-text email_error"></span>

                        </div>
                        <div class="relative z-0 mb-6 w-full group my-5">
                            <input    type="tel" pattern="[0-9]{10}" name="tel_number" id="tel_numberid" class="@error('tel_number') border-red-400 @enderror block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " >
                            <label for="tel_numberid" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone number </label>
                            <span class="text-red-500 error-text tel_number_error"></span>
                    </div>
                    <div class="relative z-0 mb-6 w-full group">
                        <input   type="date" min="{{ $min_date->format('Y-m-d') }}" name="res_date" id="res_dateid" class="@error('res_date') border-red-600 @enderror  block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" >
                        <label for="res_dateid" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Date of reservation</label>
                        <span class="text-red-500 error-text res_date_error"></span>
                    </div>

					</div>
                </div>
					<div x-show.transition.in="step === 2">
                        <div class="container bg-gray-100 m-3 my-10  px-8 py-20 rounded-lg">



                            <div class="relative z-0 mb-6 w-full group">
                                <input   type="text" name="guests_number" id="guests_numberid" class=" @error('guests_number')  border-red-400 @enderror block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " >
                                <label for="guests_numberid" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">number of guests</label>
                                <span class="text-red-500 error-text guests_number_error"></span>
                            </div>
                            <div class="relative z-0 mb-6 w-full group  @error('meal') border-red-700 @enderror">
                                <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">choose your meal appoitment</h3>
                                <select id="ul-meal" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"><option disabled>Choose a meal</option></select>
                                <span class="text-red-500 error-text meal_error"></span>

                            </div>


                            <div class="relative z-0 mb-6 w-full group  ">
                                <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">pick your table </h3>
                                <select id="ul-dropdown-menu" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"><option disabled>Choose a date</option></select>
                                <span id="selected_table" class="text-green-500"></span>


                            </div>

                            <!-- Dropdown menu -->
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 mb-6 w-full group">
                                    <div id="dropdown-menu" class="hidden z-10 w-60 bg-white rounded shadow dark:bg-gray-700">
                                        <ul id="ul-dropdown-menu" class="overflow-y-auto px-3 pb-3 h-48 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButton"></ul>
                                    </div>
                                </div>
                                 <span class="text-red-500 error-text table_error"></span>
                             </div>


                             {{-- end of dropdown --}}

					    </div>
					</div>
					<div x-show.transition.in="step === 3">
						<div class="mb-5 p-40 text-clip text-2xl">
							<h1>Confirm Your Registration, by clicking Complet</h1>
				    	</div>
                </div>
                    <!-- Bottom Navigation -->
		<div class="relative bottom-10 left-0 right-0 py-5 bg-white shadow-md" x-show="step != 'complete'">
			<div class="max-w-3xl mx-auto px-4">
				<div class="flex justify-between">
					<div class="w-1/2">
						<a type="button"
                        style= "cursor:pointer"
							x-show="step > 1"
							@click="step--"
							class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border"
						>Previous</a>
					</div>

					<div class="w-1/2 text-right">

		<a type="button"
							x-show="step < 3"
                            style= "cursor:pointer"
							@click="step++"
							class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium"
						>Next</a>
						<button
                        id='create' type="submit"
                        @click="step='complete'"
							x-show="step === 3"
							class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium"
						>Complete</button>


					</div>
				</div>
			</div>
		</div>
    </form>
		<!-- / Bottom Navigation https://placehold.co/300x300/e2e8f0/cccccc -->
				</div>
				<!-- / Step Content -->
			</div>
		</div>

		{{-- ////// --}}
	</div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script>
		function app() {
			return {
				step: 1,
			}
		}
	</script>

<script>
    let  this_data,table_id='';
    let meal='',res_date='',ul_tables=$('#ul-dropdown-menu'),ul_meal=$('#ul-meal');


let menuContent = document.getElementById('dropdown-menu');
$(document).ready(function(){

    $('#ul-dropdown-menu').on('click',function(){
        console.log('table clk')
        if($('#res_dateid').val()==='')
            $('span.table_error').text('you should choose  date and the meal');

    })
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN' : $('meta[name=csrf-token]').attr('content') }
    });


    //form validation
    $('#reservation-form-id').on('submit',function(e){
        e.preventDefault();
        table_id=$('#ul-dropdown-menu').val();

                this_data={
                            'first_name':$('#first_nameid').val(),
                            'last_name':$('#last_nameid').val() ,
                            'email': $('#emailid').val() ,
                            'res_date': $('#res_dateid').val() ,
                            'tel_number': $('#tel_numberid').val() ,
                            'guests_number': $('#guests_numberid').val(),
                            'table':table_id ,
                            'meal': meal,
                            };
                console.log(this_data);




                // validation with ajax for all inputs
                $.ajax({
                    dataType: "json",
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: this_data,
                    // processData:false,
                    beforeSend:function(){
                        $(document).find('span.error-text').text('');
                        $('#complete-div').children().remove();

                    },
                    success: function (res,st,xhr) {
                            console.log(res)
                            if(res.status==false){
                                $.each(res.error,function(prefix,val){
                                    $('span.'+prefix+'_error').text(val[0])
                                });
                                 msg_failed=`<div class="bg-white rounded-lg p-10 flex items-center shadow justify-between"><div>
						<h2 class="text-2xl mb-4 text-red-600 text-center font-bold">Registration Failed</h2>
						<div class="text-gray-600 mb-8"><a type="button" style= "cursor:pointer" x-show="step === 'complete'" @click="step=1" class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" >Back To Registration</a></div>`;
                            $('#complete-div').append(msg_failed);

                            }
                            else if(res.status=='not'){
                                $('span.guests_number_error').text(res.guests_number_error);
                                msg_failed=`<div class="bg-white rounded-lg p-10 flex items-center shadow justify-between"><div>
						<h2 class="text-2xl mb-4 text-red-600 text-center font-bold">Registration Failed</h2>
						<div class="text-gray-600 mb-8"><a type="button" style= "cursor:pointer" x-show="step === 'complete'" @click="step=2" class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" >Back To Registration</a></div>`;
                            $('#complete-div').append(msg_failed);
                            }
                            else{
                                msg_success=`<div class="bg-white rounded-lg p-10 flex items-center shadow justify-between"><div>
						<svg class="mb-4 h-20 w-20 text-green-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
						<h2 class="text-2xl mb-4 text-gray-800 text-center font-bold">Registration Success</h2>
						<div class="text-gray-600 mb-8">
						Thank you. We have sent you an email to demo@demo.test. Please click the link in the message to activate your account.</div>
						<a
							href="{{ url('/') }}"
							class="w-40 block mx-auto focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border"
						>Back to home</a>
					</div>
				</div>`;

                            $('#complete-div').append(msg_success);

                            }
                        },
                    error: function( xhr,st,tr){alert('ERROR OCCURED WHILE DELETING THE RECORD !')}
                }); //end ajax

})
//form validation


    //date ajax verifiyDate
    $('#res_dateid').on('change',function(){
        ul_tables.children().remove();
        res_date=$('#res_dateid').val();
        meal='';
        // console.log('data clicked value : '+res_date)
        $.ajax({
           method:'get',
           dataType:'json',
           url:"{{ route('admin.reservation.verifyDate') }}",
           data:{
            'res_date':res_date,
           },

           beforeSend:function(){
            menuContent.className="hidden z-10 w-60 bg-white rounded shadow dark:bg-gray-700";
                        $(document).find('span.res_date_error').text('');
                        $(document).find('span.table_error').text('');
                        ul_meal.children().remove();
                        ul_tables.children().remove();


                    },

           success:function(res){
            if(res.status==false){
                $('span.res_date_error').text(res.errors.res_date[0])
            }else{
                         ul_meal.append('<option></option>');
                        $.each(res.meal,function(index,value){
                        li_meal_node='<option value="'+value+'">'+value.toUpperCase()+'</option>';
                        ul_meal.append(li_meal_node);
                    });

                }
                // console.log('the request succeeded for meal :'+res)
            }

        });//end ajax

    });
        // //verifyMeal

        let span, selected;
        $('#ul-meal').on('change',function(){
            meal=$('#ul-meal').val();

                    $(document).find('span.table_error').text('');


    $.ajax({
           method:'get',
           dataType:'json',
           url:"{{ route('admin.reservation.verifyMeal') }}",
           data:{
            'res_date':res_date,
            'meal':meal,
           },

           beforeSend:function(){
            ul_tables.children().remove();

            if(meal===''){
                $('span.table_error').text('you should choose the meal');

            }else{

                $(document).find('span.table_error').text('');
            }
                        $(document).find('span.res_date_error').text('');
                        ul_tables.children().remove();
                        $(document).find('span.meal_error').text('');
                        $('#selected_table').text('');
                    },

           success:function(res){
            if(res.status==false){
                console.log('All tables are on hold')
                // $('span.res_date_error').text(res.errors.res_date[0])
            }else{
                ul_tables.append('<option></option>');
                $.each(res.tables,function(index,value){
                    console.log('table name: '+value.name);
                    li_table_node='<option value="'+value.id+'">'+value.name+' ('+value.guests_number +' Guests)'+'</option>';
                    ul_tables.append(li_table_node);

                });

                if(res.tables.length==0)
                  $(document).find('span.table_error').text('all tables in hold, try another date or meal');

                    }

           }

    });//end ajax

                });// end verification date



})

</script>

</body>
</x-guest-layout>
