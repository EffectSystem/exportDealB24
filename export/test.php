<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <?php

use crest\CRest;

 foreach ($arCategory as $id => $name):
        if ($id > 0)
        {
            $entity_id = 'DEAL_STAGE_' . $id;
        }
        else
        {
            $entity_id = 'DEAL_STAGE';
        }
        var_dump($entity_id);
        $resultDeal = CRest::call('crm.status.list', ['filter' => ['ENTITY_ID' => $entity_id]]);
        
        if (!empty($resultDeal['result'])):?>
            <table>
                <caption><?=$name?></caption>
                <thead>
                <tr>
                    <th>STATUS ID</th>
                    <th>NAME</th>
                    <th>SEMANTICS</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($resultDeal['result'] as $item): ?>
                <tr <?=(!empty($item['EXTRA']['COLOR']) ? ' style="color:' . $item['EXTRA']['COLOR'] . '"' : '');?>>
                    <td><?=$item['STATUS_ID']?></td>
                    <td><?=$item['NAME']?></td>
                    <td><?=$item['EXTRA']['SEMANTICS']?></td>
                <tr>
                <?php endforeach;?>
                </tbody>
            </table>
        <?php endif; ?>
    <?php endforeach; ?>
</body>
</html>