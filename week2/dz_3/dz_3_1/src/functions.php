<?php

function getRandomName(): string
{
    $names = [
        'Мария',
        'Сергей',
        'Игорь',
        'Марина',
        'Артем'
    ];
    $idx = rand(0, sizeof($names) - 1);
    return $names[$idx];
}


function generateUsersArray(int $startPos = 0, int $finishPos = 50): array
{
    $users = [];
    for ($i = $startPos; $i < $finishPos; $i++) {
        $users[] = [
            'id' => $i,
            'name' => getRandomName(),
            'age' => rand(18, 45),
        ];
    }
    return $users;
}


function saveToFileAsJSON(string $filename, array $arr)
{
    file_put_contents($filename, json_encode($arr));
}


function openJSONFileAsArray(string $filename)
{
    return json_decode(file_get_contents($filename), true);
}


function getCountNames(array $arr): array
{
    $namesCount = [];
    foreach ($arr as $key => $value) {
        if (!array_key_exists($value['name'], $namesCount)) {
            $namesCount[$value['name']] = 0;
        }
        $namesCount[$value['name']] += 1;
    }
    return $namesCount;
}


function getAverageAge(array $arr): float
{
    $count = 0;
    $sum = 0;
    foreach ($arr as $key => $value) {
        foreach ($value as $item => $val) {
            if ($item == 'age') {
                $sum += $val;
                $count++;
            }
        }
    }
    return round($sum / $count);
}


function task3_1()
{
    $users = generateUsersArray();
    $filename = 'users.json';

    saveToFileAsJSON($filename, $users);
    $loadedUsers = openJSONFileAsArray($filename);

    return [
        'names' => getCountNames($loadedUsers),
        'averageAge' => getAverageAge($loadedUsers),
    ];
}
