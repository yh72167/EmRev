<?php

  namespace classes\etc;
  use \PDO;
  use \RuntimeException;
  use \Exception;
  use classes\db\dbConnectFunction;
  use classes\db\dbConnectPDO;
  use classes\debug\debugFunction;

  class getUserProp{

    protected $username;
    protected $age;
    protected $tel;
    protected $addr;
    protected $dmState;

    public function __construct($username,$age,$tel,$addr,$dmState){
      $this->username->$username;
      $this->$age;
      $this->$tel;
      $this->$addr;
      $this->$dmState;
    }

    // ユーザーのプロフィール情報の取得
    public static function getUserProp($u_id){
      debugFunction::debug('ユーザー情報を取得します。');
      //例外処理
      try {
        //接続情報をまとめたクラス
        $dbh = new dbConnectPDO();
        //SQL文作成
        //ON句は結合条件を指定するもの。今回の場合だとuserテーブル内のidカラムとemployee_profsテーブルの
        //user_idテーブルのuser_idカラム内のレコードがWHERE句で当てはまった値(session['user_id']の数字)と一緒のものを
        //取得する。
        $sql = 'SELECT * FROM users AS u LEFT JOIN general_profs AS gp ON u.id = gp.user_id WHERE u.id = :u_id';
        $data = array(':u_id' => $u_id);
        // クエリ実行
        $stmt = dbConnectFunction::queryPost($dbh->getPDO(), $sql, $data);
        // クエリ成功の場合
        if($stmt){
          debugFunction::debug('クエリ成功。');
        }else{
          debugFunction::debug('クエリに失敗しました。');
        }

      } catch (Exception $e) {
        error_log('エラー発生:' . $e->getMessage());
      }
      // クエリ結果のデータを返却
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }
  }

?>