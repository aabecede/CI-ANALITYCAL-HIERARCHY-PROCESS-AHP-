<div class="row">
	<?php

	$att_input = array( //attribute form_input
                    	'nama_lengkap' => array(
                    		'class' => 'form-control',
                    		'placeholder' => 'Nama Lengkap',
                    		'required' => 'required',
                    		),
                    	'username' => array(
                    		'class' => 'form-control',
                    		'placeholder' => 'Username',
                    		'required' => 'required',
                    	),
                    	'pw' => array(
                    		'class' => 'form-control',
                    		'placeholder' => 'password',
                    		'required' => 'required',
                    	)
                    );

	echo form_open('admin/edit_user/'.$data->id);
	echo form_label('Nama', 'nama_lengkap');
	echo form_input('nama_lengkap', $data->nama_lengkap, $att_input['nama_lengkap']);
	echo form_label('Username', 'username');
    echo form_input('username', $data->username, $att_input['username']);
    echo form_label('Password', 'password');
    echo form_password('password', $data->com_pas , $att_input['pw']);
    echo "<input type='submit' class='btn btn-dark' value='Edit'>";
	echo form_close();
	?>	
</div>