<?php

namespace import\model;

use export\classes\Deb;
use import\crest\CRest;

class Task 
{
    public function get($id)
    {
        return CRest::call('tasks.task.get', 
            [
                'id' => $id
            ]
        );
    }

    public function getByIdDeal($idDeal)
    {
        return CRest::call('tasks.task.list', [
            'filter' => [
                'UF_CRM_TASK' => "D_".$idDeal
            ]
        ]);
    }


   /* пример $data =
        [
            'TITLE' => 'TEST',
            'UF_CRM_TASK' => ["D_".$idDeal],
            'RESPONSIBLE_ID' => 1
        ]
    */
    public function add($idDeal, array $data)
    {
       return CRest::call('tasks.task.add', [
            'fields' => $data
        ]);
    }

    public function addForDeal(array $data)
    {
        // $data['UF_CRM_TASK'] = ["D_".$idDeal] ?? null;
        // $data['RESPONSIBLE_ID'] = $responible ?? null;
        // $data['TITLE'] = $data['title'];
        // $data['CREATED_BY'] = 
        // unset($data['title']);

        //Deb::print($data);
        
        return CRest::call('tasks.task.add', 
            [
                'fields' => $data               
            ]
        );
    }

    public function addAllForDeal($idDeal, array $data)
    {
        foreach ($data['result']['tasks'] as $task) {
            //Deb::print($task);
            $exportUser = new \export\model\User();
            $exportUserName = $exportUser->getLastNameAndName($task['responsibleId']);

            $importUser = new \import\model\User();
            $importUserId = $importUser->getIdByLastName($exportUserName);
            $responible = $importUserId;


            $task['UF_CRM_TASK'] = ["D_".$idDeal] ?? null;
            $task['RESPONSIBLE_ID'] = $responible ?? null;
            $task['TITLE'] = $task['title'];
            $task['CREATED_BY'] = $importUser->getIdByLastName($exportUser->getLastNameAndName($task['createdBy']));
            $task['STATUS'] = $task['status'];             
            unset($task['title']);

            $res = $this->addForDeal($task);
            //Deb::print($res);
        }
    }

    public function mapping($data)
    {
        return [
            //'PARENT_ID' => $data['parentId'],
            'TITLE' => $data['title'],
            // 'DESCRIPTION' => $data['description'] ?? '',
            // 'MARK' => $data['mark'],
            'PRIORITY' => $data['priority'],
            'STATUS' => $data['status'],
            // 'MULTITASK' => $data['multitask'],
            // 'NOT_VIEWED' => $data['notViewed'],
            // 'REPLICATE' => $data['replicate'],
            // 'GROUP_ID' => $data['groupId'],
            // 'STAGE_ID' => $data['stageId'],                        
            'CREATED_BY' => $data['createdBy'],
            'CREATED_DATE' => $data['createdDate'],           
            'RESPONSIBLE_ID' => $data['responsibleId'],
            'ACCOMPLICES' => $data['accomplices'],
            'AUDITORS' => $data['auditors'],            
            'CHANGED_BY' => $data['changedBy'],
            'CHANGED_DATE' => $data['changedDate'],
            'STATUS_CHANGED_BY' => $data['statusChangedBy'],
            'CLOSED_BY' => $data['closedBy'],
            'CLOSED_DATE' => $data['closedDate'],
            'DATE_START' => $data['dateStart'],
            'DEADLINE' => $data['deadline'],
            // 'START_DATE_PLAN' => $data['startDatePlan'],
            // 'END_DATE_PLAN' => $data['endDatePlan'],
            // 'GUID' => $data['guid'],
            // 'XML_ID' => $data['xmlId'],
            'COMMENTS_COUNT' => $data['commentsCount'],
            'NEW_COMMENTS_COUNT' => $data['newCommentsCount'],
            // 'ALLOW_CHANGE_DEADLINE' => $data['allowChangeDeadline'],
            // 'TASK_CONTROL' => $data['taskControl'],
            // 'ADD_IN_REPORT' => $data['addInReport'],
            // 'FORKED_BY_TEMPLATE_ID' => $data['forkedByTemplateId'],
            // 'TIME_ESTIMATE' => $data['timeEstimate'],
            // 'TIME_SPENT_IN_LOGS' => $data['timeSpentInLogs'],
            // 'MATCH_WORK_TIME' => $data['matchWorkTime'],
            // 'FORUM_TOPIC_ID' => $data['forumTopicId'],
            // 'FORUM_ID' => $data['forumId'],
            // 'SITE_ID' => $data['siteId'],
            // 'SUBORDINATE' => $data['subordinate'],
            // 'FAVORITE' => $data['favorite'],
            // 'EXCHANGE_MODIFIED' => $data['exchangeModified'],
            // 'EXCHANGE_ID' => $data['exchangeId'],
            // 'OUTLOOK_VERSION' => $data['outlookVersion'],
            // 'VIEWED_DATE' => $data['viewedDate'],
            // 'SORTING' => $data['sorting'],
            // 'DURATION_PLAN' => $data['durationPlan'],
            // 'DURATION_FACT' => $data['durationFact'],
            // 'CHECKLIST' => $data['checklist'],
            // 'DURATION_TYPE' => $data['durationType'],
            // 'UF_CRM_TASK' => $data['ufCrmTask'],
            // 'UF_TASK_WEBDAV_FILES' => $data['ufTaskWebdavFiles'],
            // 'UF_MAIL_MESSAGE' => $data['ufMailMessage'],
            // 'IS_MUTED' => $data['isMuted'],
            // 'IS_PINNED' => $data['isPinned'],
            // 'IS_PINNED_IN_GROUP' => $data['isPinnedInGroup'],
            // 'SERVICE_COMMENTS_COUNT' => $data['serviceCommentsCount']
        ];
    }
}