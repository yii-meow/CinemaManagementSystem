from flask import Flask, request, jsonify
from googleapiclient.discovery import build
from googleapiclient.errors import HttpError

app = Flask(__name__)

# Your API key
API_KEY = "AIzaSyCV8moVHl9EoZm71XZIax6dZbxeHU4F0PE"

youtube = build('youtube', 'v3', developerKey=API_KEY)

@app.route('/fetch_trailer', methods=['GET'])
def fetch_trailer():
    movie_title = request.args.get('title', '')
    if not movie_title:
        return jsonify({"error": "No movie title provided"}), 400

    try:
        search_response = youtube.search().list(
            q=f"{movie_title} official trailer",
            type="video",
            part="id,snippet",
            maxResults=1
        ).execute()

        if search_response['items']:
            video_id = search_response['items'][0]['id']['videoId']
            trailer_link = f"https://www.youtube.com/watch?v={video_id}"
            return jsonify({"trailer_link": trailer_link})
        else:
            return jsonify({"error": "No trailer found"}), 404

    except HttpError as e:
        return jsonify({"error": f"An error occurred: {e}"}), 500

if __name__ == '__main__':
    app.run(debug=True, port=5000)