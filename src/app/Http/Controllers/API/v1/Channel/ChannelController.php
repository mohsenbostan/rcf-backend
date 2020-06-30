<?php

namespace App\Http\Controllers\API\v1\Channel;

use App\Channel;
use App\Http\Controllers\Controller;
use App\Repositories\ChannelRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ChannelController extends Controller
{
    public function getAllChannelsList()
    {
        $all_channels = resolve(ChannelRepository::class)->all();
        return response()->json($all_channels, Response::HTTP_OK);
    }

    /**
     * Create New Channel
     * @param Request $request
     * @return JsonResponse
     */
    public function createNewChannel(Request $request)
    {
        $request->validate([
            'name' => ['required']
        ]);

        // Insert Channel To Database
        resolve(ChannelRepository::class)->create($request->name);

        return response()->json([
            'message' => 'channel created successfully'
        ], Response::HTTP_CREATED);
    }

    /**
     * Update Channel
     * @param Request $request
     * @return JsonResponse
     */
    public function updateChannel(Request $request)
    {
        $request->validate([
            'name' => ['required']
        ]);

        // Update Channel In Database
        resolve(ChannelRepository::class)->update($request->id, $request->name);

        return response()->json([
            'message' => 'channel edited successfully'
        ], Response::HTTP_OK);
    }

    /**
     * Delete Channel(s)
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteChannel(Request $request)
    {
        $request->validate([
            'id' => ['required']
        ]);

        // Delete Channel In Database
        resolve(ChannelRepository::class)->delete($request->id);

        return response()->json([
            'message' => 'channel deleted successfully'
        ], Response::HTTP_OK);
    }
}
