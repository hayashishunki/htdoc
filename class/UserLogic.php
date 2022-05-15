<?php       //ユーザーを情報を登録
require_once '../dbconect.php';


class UserLogic
{

    //ユーザーを登録する
    public static function createUser($userDate)
    {
        $result = false;
        $sql = 'INSERT INTO user (name, email, password) VALUES(?, ?, ?)'; //?にはプレスホルダーの配列を値に入れる

        //ユーザーデータを配列に入れる
        $arr = []; //arrに配列を入れる
        $arr[] = $userDate['username']; //その配列に入れる方法
        $arr[] = $userDate['email']; //その配列に入れる方法
        $arr[] = password_hash($userDate['password'], PASSWORD_DEFAULT);
        //その配列に入れる,パスワードを簡単に見られないようにハッシュ化,第二引数PASSWORD_DEFAULTでDEFAULTで設定

        try {
            //データベースに接続
            $stmt = connect()->prepare($sql);
            $result = $stmt->execute($arr); //execute()に＄arrを入れてあげるとprepaer()で準備した$sqlのVALUE(?)が入ってくる
            //うまく行ったかの結果を$resultに
            return $result;
        } catch (\Exception $e) {
            echo $e;
        }
    }

    public static function login($email, $password)
    {

        //結果初期値falseにすることでtrueにしないとログインできないようにする(初期値に設定しとけば比較が楽になる　true or false)
        $result = false;
        //ユーザーをemailから検索する
        $user = self::getUserByEmail($email); //同じロジック内の場合selfでも良い

        if (!$user) {
            $_SESSION['msg'] = 'emailが一致しません';
            return $result;
        }
        //パスワードの照会
        if (password_verify($password, $user['password'])) {
            //ログイン成功
            session_regenerate_id(true); //古いsessionを破棄して新しいsessionを作る。
            $_SESSION['login_user'] = $user;
            $result = true;
            return $result;
        }

        $_SESSION['msg'] = 'パスワードが一致しません。';
        return $result;
    }

    public static function getUserByEmail($email)
    {

        //SQLの準備
        //SQLの実行
        //SQLの結果を返す
        $sql = 'SELECT * FROM user WHERE email =  ?';

        //ユーザーデータを配列に入れる
        $arr = []; //arrに配列を入れる
        $arr[] = $email;
        try {
            //データベースに接続
            $stmt = connect()->prepare($sql);
            $stmt->execute($arr); //execute()に＄arrを入れてあげるとprepaer()で準備した$sqlのVALUE(?)が入ってくる
            //fetchはSQLの結果を返す。
            $user = $stmt->fetch();
            return $user;
        } catch (\Exception $e) {
            return false;
        }
    }

    //ログインチェック
    public static function checkLogin() {

    //セッションにログインユーザーが入っていなければもしくはid存在しているか
    if(!isset($_SESSION['login_user']) || $_SESSION['login_user']['id'] === 0) {
            return false;
    }
    return true;
    }

    public static function logout() {

        $_SESSION = array();
        session_destroy();
    }
}
