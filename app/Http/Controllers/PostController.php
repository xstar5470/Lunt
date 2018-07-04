<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    /*
     * 文章列表
     */
    public function index(UserService $user)
    {
        $data = Post::with(['user'])->paginate(6);
        $user = $user->user;
        return view('posts/index',compact('data','user'));
    }


    public function create(UserService $user)
    {
        $user = $user->user;
        return view('posts/create',compact('user'));
    }

    public function store(Request $request)
    {
        $data = $request->only('title','content');
        $post_id = $request->input('post_id');
        $rules = [
            'title' => 'required|min:4',
            'content' => 'required'
        ];
        $message = [
            'title.required' => "标题不能为空",
            'title.min' => '标题至少为四个字符',
            'content' => '内容不能为空'
        ];
        $validator = Validator::make($data,$rules,$message);
        if($validator->fails()){
            return err('',$validator->errors()->first());
        }
        if($post_id){
            $post = Post::where('id',$post_id)->first();
            try{
                $this->authorize('update',$post);
            }catch (\Exception $e){
                return err('','您不能操作该文章');
            }
            $post->update($data);
        }else{
            $params = array_merge($data, ['user_id' => \Auth::id()]);
            Post::create($params);
        }
        return res('','提交成功');
    }

    public function edit(Post $post,UserService $user)
    {
        $user = $user->user;
        return view('posts/edit', compact('post','user'));
    }

    public function show(Post $post,UserService $user)
    {
        $user = $user->user;
        return view('posts/show', compact('post','user'));
    }

    /*
     * 文章评论保存
     */
    public function comment()
    {
        $this->validate(request(),[
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|min:10',
        ]);

        $user_id = \Auth::id();

        $params = array_merge(
            request(['post_id', 'content']),
            compact('user_id')
        );
        \App\Comment::create($params);
        return back();
    }

    /*
     * 点赞
     */
    public function zan(Post $post)
    {
        $zan = new \App\Zan;
        $zan->user_id = \Auth::id();
        $post->zans()->save($zan);
        return back();
    }

    /*
     * 取消点赞
     */
    public function unzan(Post $post)
    {
        $post->zan(\Auth::id())->delete();
        return back();
    }

    /*
     * 搜索页面
     */
    public function search()
    {
        $this->validate(request(),[
            'query' => 'required'
        ]);

        $query = request('query');
        $posts = Post::search(request('query'))->paginate(10);
        return view('post/search', compact('posts', 'query'));
    }

    public function delete(Post $post){
        try{
            $this->authorize('delete',$post);
        }catch (\Exception $e){
            return err('','您不能操作该文章');
        }
        $post->delete();
        return res('','删除成功');
    }


}
