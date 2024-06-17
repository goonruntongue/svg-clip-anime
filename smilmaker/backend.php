<?php
// ダウンロードが動作しない場合は以下のコメントを外す
// CORSヘッダーを設定
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// OPTIONSリクエストへの対応（プリフライトリクエスト）
// if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//     http_response_code(200);
//     exit();
// }

header("Content-Type: application/json");

$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (json_last_error() === JSON_ERROR_NONE) {
    $svgCode = $data["svg"];

    // フォルダのパス
    $directory = "svg";

    // フォルダが存在しない場合、作成
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }

    // ファイル名を含むフルパス
    $filename = $directory . "/SMIL.svg";

    // ファイルを書き込む
    file_put_contents($filename, $svgCode);

    // レスポンスを返す
    echo json_encode(["filename" => "SMIL.svg"]);
} else {
    echo json_encode(["error" => "Invalid JSON received"]);
}
