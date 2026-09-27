<ul id="menu">
  <li id="dashboard"><a href="<?php echo $home; ?>"><i class="fa fa-lg fa-fw fa-home"></i> <span><?php echo $text_dashboard; ?></span></a></li>
  <li id="catalog"><a class="parent"><i class="fa fa-paw"></i> <span><?php echo $text_item_management; ?></span></a>
    <ul>
      <li><a href="<?php echo $item; ?>"><?php echo $text_item_list; ?></a></li>     
    </ul>
  </li>
  <li id="sale"><a class="parent"><i class="fa fa-files-o"></i> <span><?php echo $text_boarding; ?></span></a>
    <ul>
      <li><a href="<?php echo $entry; ?>"><?php echo $text_check_in; ?></a></li>
	  <li><a href="<?php echo $advance_booking; ?>"><?php echo $text_booking; ?></a></li>
	  <li><a href="<?php echo $online_booking; ?>"><?php echo $text_online_booking; ?></a></li>
    </ul>
  </li>
  
  <li id="system"><a class="parent"><i class="fa fa-user"></i> <span><?php echo $text_customer; ?></span></a>
    <ul>
      <li><a href="<?php echo $customer; ?>"><?php echo $text_customer; ?></a></li>
	  <li><a href="<?php echo $contact; ?>">Bulk Mail</a></li>
	  <li><a href="<?php echo $sms; ?>">Bulk SMS</a></li>
    </ul>
  </li>
  <li id="tools"><a class="parent"><i class="fa fa-money"></i> <span><?php echo $text_expense; ?></span></a>
    <ul>
      <li><a href="<?php echo $expense; ?>"><?php echo $text_expense; ?></a></li>
      <li><a href="<?php echo $expense_head; ?>"><?php echo $text_expense_head; ?></a></li>
    </ul>
  </li>
  <li id="reports"><a class="parent"><i class="fa fa-bar-chart"></i> <span><?php echo $text_reports; ?></span></a>
    <ul>
      <li><a href="<?php echo $boarding_report; ?>"><?php echo $text_boarding_details; ?></a></li>
      <li><a href="<?php echo $advance_booking_report; ?>"><?php echo $text_advance_booking; ?></a></li>
      <li><a href="<?php echo $accountant_report; ?>"><?php echo $text_accountant; ?></a></li>
      <li><a href="<?php echo $vaccination_report; ?>"><?php echo $text_vaccination; ?></a></li>
      <li><a href="<?php echo $consolidated_invoice_report; ?>"><?php echo $text_consolidated_invoice; ?></a></li>
    </ul>
  </li>

  <li id="user"><a class="parent"><i class="fa fa-user"></i> <span><?php echo $text_user_management; ?></span></a>
    <ul>
	  <li><a href="<?php echo $user; ?>"><?php echo $text_user; ?></a></li>
	  <li><a href="<?php echo $user_profile; ?>"><?php echo $text_user_profile; ?></a></li>
	  <li><a href="<?php echo $user_group; ?>"><?php echo $text_user_groups; ?></a></li>     
    </ul>
  </li>
  <li id="user"><a class="parent"><i class="fa fa-envelope-o"></i> <span>Auto Messeging</span></a>
    <ul>
	  <li><a href="<?php echo $emailtemplate; ?>">Email Template</a></li>
      <li><a href="<?php echo $smstemplate; ?>">SMS Template</a></li>     
    </ul>
  </li>
  <li id="setting"><a class="parent"><i class="fa fa-cog fa-fw"></i> <span><?php echo $text_settings; ?></span></a>
    <ul>
      <li><a href="<?php echo $setting; ?>"><?php echo $text_settings; ?></a></li>
      <li><a href="<?php echo $backup; ?>"><?php echo $text_backup; ?></a></li>
      <li><a href="<?php echo $logs; ?>"><?php echo $text_error_log; ?></a></li>
    </ul>
  </li>
</ul>
