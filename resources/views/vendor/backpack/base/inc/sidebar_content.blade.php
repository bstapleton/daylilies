<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
<li><a href='{{ backpack_url('breeder') }}'><i class='fa fa-user'></i> <span>Breeders</span></a></li>
<li><a href='{{ backpack_url('plant') }}'><i class='fa fa-leaf'></i> <span>Plants</span></a></li>

<li><a href='{{ backpack_url('category') }}'><i class='fa fa-folder'></i> <span>Categories</span></a></li>