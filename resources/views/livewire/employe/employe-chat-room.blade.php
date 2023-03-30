<div>
    <div class="row justify-content-center align-items-center g-2 m-0 p-0 bg-light">
        {{-- @php
            echo '<pre>';
            print_r($chat);
        @endphp --}}
        <section class="col-lg-8 connectedSortable" wire:poll="refreshing">
            {{-- @php
                echo '<pre>';
                print_r($agent);
            @endphp --}}
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary" wire:ignore.self>
                <div class="card-header bg-danger">
                    <h3 class="card-title">Private chat</h3>
                    <div class="card-tools">
                        {{-- <span title="3 New Messages" class="badge badge-primary">3</span> --}}
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                            <i class="fas fa-comments"></i>
                        </button>
                        {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button> --}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body bg-slate-400">

                    <!-- Conversations are loaded here -->
                    <div class="p-3">
                        <!-- Message. Default to the left -->
                        {{-- <div class="text-center text-primary">vddg</div> --}}
                        <div>
                            @if ($chat != [])
                                <div>
                                    @foreach ($chat as $ct)
                                        <div>
                                            @if ($ct['sender']['id'] == $me)
                                                <div class="direct-chat-msg right my-1 py-1">
                                                    <div class="direct-chat-infos clearfix">
                                                        <span
                                                            class="direct-chat-name float-left">You({{ $ct['sender']['name'] }})</span>
                                                        <span
                                                            class="direct-chat-timestamp float-right">{{ $ct['created_at'] }}</span>
                                                    </div>
                                                    <!-- /.direct-chat-infos -->
                                                    <img class="direct-chat-img"
                                                        src="{{ asset('storage/employe_' . $ct['sender']['id']) }}/{{ $ct['sender']['image'] }}"
                                                        alt="">
                                                    <!-- /.direct-chat-img -->
                                                    <div class="direct-chat-text bg-info py-3">
                                                        {{ $ct['message'] }}
                                                    </div>
                                                    <!-- /.direct-chat-text -->
                                                </div>
                                            @else
                                                <div class="direct-chat-msg my-1 py-1">
                                                    <div class="direct-chat-infos clearfix">
                                                        <span
                                                            class="direct-chat-name float-left">{{ $ct['sender']['name'] }}</span>
                                                        <span
                                                            class="direct-chat-timestamp float-right">{{ $ct['created_at'] }}</span>
                                                    </div>
                                                    <!-- /.direct-chat-infos -->
                                                    <img class="direct-chat-img"
                                                        src="{{ asset('storage/employe_' . $ct['sender']['id']) }}/{{ $ct['sender']['image'] }}"
                                                        alt="">
                                                    <!-- /.direct-chat-img -->
                                                    <div class="direct-chat-text bg-success py-3">
                                                        {{ $ct['message'] }}
                                                    </div>
                                                    <!-- /.direct-chat-text -->
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach

                                </div>
                            @endif

                        </div>

                    </div>
                    <!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->
                    <div class="direct-chat-contacts">
                        <ul class="contacts-list">
                            {{-- <div> --}}
                            @foreach ($users as $user)
                                <li>
                                    <a href="#" data-widget="chat-pane-toggle"
                                        wire:click="getChat({{ $user->id }})">
                                        <img class="contacts-list-img"
                                            src="{{ asset('storage/employe_' . $user->id) }}/{{ $user->image }}"
                                            alt="no image">

                                        <div class="contacts-list-info">
                                            <span class="contacts-list-name">
                                                {{ $user->name }}
                                                <small class="contacts-list-date float-right">2/28/2015</small>
                                            </span>
                                            <span class="contacts-list-msg">cvv</span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                    </a>
                                </li>
                            @endforeach

                            {{-- </div> --}}
                            <!-- End Contact Item -->
                        </ul>
                        <!-- /.contacts-list -->
                    </div>
                    <!-- /.direct-chat-pane -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <form action="#" method="post" wire:submit.prevent="sendMsg">
                        <div class="input-group">
                            <input type="text" name="message" placeholder="Type Message ..." class="form-control"
                                wire:model="message">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-send-fill"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->

        </section>
    </div>
</div>
<!-- /.col -->
