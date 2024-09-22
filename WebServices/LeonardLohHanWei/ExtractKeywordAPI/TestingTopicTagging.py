# Author: Leonard Loh Han Wei
import requests

# The API URL
url = "http://localhost/CinemaManagementSystem/app/services/ExtractKeywordAPI/TopicTaggingService.php"
feedback = "I recently visited CinemaX to watch the latest blockbuster, and overall, the experience was good but with room for improvement. The seats were comfortable, and the sound quality was excellent, providing a truly immersive experience. However, the cleanliness of the theater could have been better — there was some trash left from the previous show, which slightly detracted from the enjoyment."

# The data to send to the API
data = {
    "paragraph": feedback
}

# Send POST request to the API
response = requests.post(url, json=data)

# Print the raw response text (to see what the API returned)
#print("Raw response text:", response.text)

# Check if the request was successful
if response.status_code == 200:
    try:
        # Attempt to parse the JSON
        keywords = response.json()
        #print result

        print("Feedback: ", feedback)
        print("\n")
        print("Extracted Keywords from feedback:", keywords)
    except ValueError as e:
        print("Error decoding JSON:", e)
else:
    print("Error:", response.status_code, response.text)

