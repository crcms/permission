<?php

namespace CrCms\Permission\Contracts;

interface UserRoleBindContract
{
    public function userAttachRoles(UserRoleRelationContract $model, array $roleIds): void;

    public function userDetachRoles(UserRoleRelationContract $model, array $roleIds): void;
}