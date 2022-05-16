<?php       //ユーザーを情報を登録
require_once '../dbconect.php';


class UserLogic {

    //ユーザーを登録する
    public function createUser($userDate) {
        $result = false;
        $sql = 'INSERT INTO users (name, email, password) VALUES(?, ?, ?)';//?にはプレスホルダーの配列を値に入れる

        //ユーザーデータを配列に入れる
        $arr = [];//arrに配列を入れる
        $arr[] = $userDate['username'];//その配列に入れる方法
        $arr[] = $userDate['email'];//その配列に入れる方法
        $arr[] = password_hash($userDate['password'], PASSWORD_DEFAULT);
        //その配列に入れる,パスワードを簡単に見られないようにハッシュ化,第二引数PASSWORD_DEFAULTでDEFAULTで設定
        
        try {
            //データベースに接続
            $stmt = connect()->prepare($sql);
            $result = $stmt->execute($arr);//execute()に＄arrを入れてあげるとprepaer()で準備した$sqlのVALUE(?)が入ってくる
            //うまく行ったかの結果を$resultに
            return $result;

            } catch(\Exception $e) {
            return $result;
            echo $e;

        }
        


    }
}
?>