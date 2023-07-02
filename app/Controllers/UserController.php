<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $user;
    function __construct()
    {
        helper('form');
        $this->user = new userModel();
    }
    public function index()
    {
        $userModel = new UserModel();
        $users = $userModel->where('is_aktif', 'false')->findAll();
        return view('pages/user', ['users' => $users]);
    }
    public function update($userId)
    {
        if (session()->get('role') === 'admin') {
            $userModel = new UserModel();
            $user = $userModel->find($userId);
    
            if ($user) {
                $userstatus = $user['is_aktif'] === 'false';
    
                if ($userstatus) {
                    $userModel->update($userId, ['is_aktif' => 'true']);
                    return redirect()->back()->with('message', 'User status updated successfully.');
                } else {
                    return redirect()->back()->with('failed', 'User not found or already active.');
                }
            } else {
                return redirect()->back()->with('failed', 'User not found.');
            }
        } else {
            return redirect()->back()->with('failed', 'You do not have permission to perform this action.');
        }
    }
    
    public function destroy($id)
    {
        $userModel = new UserModel();
        $userModel->where('id', $id)->delete();
        // Redirect to another page or return a response
        return redirect()->back()->with('message', 'User deleted successfully');
    }
}
