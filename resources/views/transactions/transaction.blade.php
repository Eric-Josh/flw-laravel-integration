<x-guest-layout>

<div class="py-12">
    <div class="mt-10 max-w-2xl mx-auto py-12 px-9 sm:px-6 sm:px-4 overflow-hidden shadow sm:rounded-lg"> 
        <div class="content">
            <div class="container ">
                @if (session('status'))
                <!-- The Modal -->
                <div class="modal fade" id="status">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <!-- Modal body -->
                            <div class="modal-body" id="mbody">
                                {{ session('status') }}
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="main-button" data-dismiss="modal"><a style="color:#ffffff">Close</a></button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if (session('status'))
                <div class="alert alert-danger" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
                @endif
                <form method="POST" action="{{ route('billing.store') }}" >
                @csrf

                    <div class="row">
                        <div class="col-sm-6 ">
                            <div class="form-group">
                                <label for="firstname">First name</label>
                                <input type="text" class="form-control lock mt-1 w-full border-gray-300 focus:border-indigo-300 
                                                    focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                                    name="firstname" value="{{ old('firstname') }}" required /> 
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="lastname">Last name</label>
                                <input type="text" class="form-control lock mt-1 w-full border-gray-300 focus:border-indigo-300 
                                                    focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                                    name="lastname" value="{{ old('lastname') }}" required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 ">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control lock mt-1 w-full border-gray-300 focus:border-indigo-300 
                                                    focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                                    name="email" value="{{ old('email') }}" required />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="phone">Phone number</label>
                                <input type="tel" class="form-control lock mt-1 w-full border-gray-300 focus:border-indigo-300 
                                                    focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                                    name="phone" value="{{ old('phone') }}" required />
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="main-button float-right"><a style="color:#ffffff">Proceed</a></button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    if($('#mbody').text() != '' ){
        $('#status').modal('show');
    }
</script>
</x-guest-layout>