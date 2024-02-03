<table class="table"  class="display nowrap" id="manageSmsTable">
  <thead>
  <th>
    S.No.
  </th>
  <th>
    Date
  </th>
  <th>
    Member Name
  </th>
  <th>
    Mobile No.
  </th>
  <th>
    Message Text
  </th>
  <th>
    Status
  </th>
  </thead>

  <tbody>
    
<?php foreach ($smslist as $smslst): ?>
                                
                                <tr>

                                    <td><?php echo $smslst['rw']; ?></td>
                                    <td><?php echo $smslst['dateTS']; ?></td>
                                    <td><?php echo $smslst['mname']; ?></td>
                                    <td><?php echo $smslst['sms_to']; ?></td>
                                    <td><?php echo $smslst['sms_text']; ?></td>
                                    <td><?php echo $smslst['status']; ?></td>
                                </tr>

<?php endforeach ?>




    
  </tbody>

 </table>
s